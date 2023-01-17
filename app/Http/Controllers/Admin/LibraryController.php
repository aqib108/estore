<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Event;
use App\Models\Admin\Library;
use App\Models\Admin\LibraryType;
use App\Models\Admin\Language;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Auth;
use DB;
use DataTables;


use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;
use Storage;

class LibraryController extends Controller
{
    public function index(Request $request)
    {

        if (!have_right('Access-Library-Image')&& !have_right('Access-Library-Video') && !have_right('Access-Library-Book') && !have_right('Access-Library-Audio') )
            access_denied();

        return redirect('/admin');
        $data = [];
        if ($request->ajax()) {
            $db_record = LibraryType::all();

            $datatable = Datatables::of($db_record);
            $datatable = $datatable->addIndexColumn();

            $datatable = $datatable->editColumn('status', function ($row) {
                $status = '<span class="badge badge-danger">Disable</span>';
                if ($row->status == 1) {
                    $status = '<span class="badge badge-success">Active</span>';
                }
                return $status;
            });
            $datatable = $datatable->addColumn('action', function ($row) {
                $actions = '<span class="actions">';

                if (have_right('Access-Library-Image')|| have_right('Access-Library-Video') || have_right('Access-Library-Book') || have_right('Access-Library-Audio')) {
                    $actions .= '&nbsp;<a class="btn btn-primary" href="' . url("admin/library/" . $row->id) . '/edit' . '" title="Edit"><i class="far fa-edit"></i></a>';
                }

                if (have_right('Access-Library-Image')|| have_right('Access-Library-Video') || have_right('Access-Library-Book') || have_right('Access-Library-Audio')) {
                    $actions .= '<form method="POST" action="' . url("admin/library/" . $row->id) . '" accept-charset="UTF-8" style="display:none;">';
                    $actions .= '<input type="hidden" name="_method" value="DELETE">';
                    $actions .= '<input name="_token" type="hidden" value="' . csrf_token() . '">';
                    $actions .= '<button class="btn btn-danger" style="margin-left:02px;" type="button" onclick="showConfirmAlert(this)" title="Delete">';
                    $actions .= '<i class="far fa-trash-alt"></i>';
                    $actions .= '</button>';
                    $actions .= '</form>';
                }

                $actions .= '</span>';
                return $actions;
            });

            $datatable = $datatable->rawColumns(['status', 'action']);
            $datatable = $datatable->make(true);
            return $datatable;
        }

        return view('admin.library.listing', $data);
    }

    public function create()
    {
        // if (!have_right('View-Library-Image') || !have_right('View-Library-Video') || !have_right('View-Library-Audio') || !have_right('View-Library-Book') || !have_right('View-Library-Document'))
        //     access_denied();

        $data = [];
        $data['row'] = new Library();
        $data['action'] = 'add';
        $data['languages'] = Language::all();
        $libraryTypes = LibraryType::where('status', 1)->get();
        $data['libraryTypes'] = $libraryTypes;

        return View('admin.library.form', $data);
    }
    //_______________Store Data Of Library Images Is not Included____________//
    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $validator = Validator::make($request->all(), [
            'type_id' => 'required',
            'content' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('flash_danger', $validator->messages());
            return redirect()->back()->withInput();
        }

        if ($input['action'] == 'edit') {
            unset($input['action']);
            // if (!have_right('edit-Library'))
            //     access_denied();
            if (isset($request->old_libraries_ids)) {

                $old_ids = $request->old_libraries_ids;
                $old_data_for_delete_file = DB::table('libraries')->whereNotIn('id', $old_ids)->where('type_id', $request->type_id)->get();

                foreach ($old_data_for_delete_file as $key => $val) {
                    $this->deleteEditoImage($val->file);
                }

                DB::table('libraries')->whereNotIn('id', $old_ids)->where('type_id', $request->type_id)->delete();
                //________________old_libraries_ids contain all ids for update library data_____//
                foreach ($request->old_libraries_ids as $key => $val) {
                    $model  = Library::find($val);
                    $model->type_id = $request->type_id;
                    $model->description = $request->description[$key];
                    $model->file_title = $request->file_title[$key];
                    $model->update();
                }
            }
            $model = LibraryType::find($request->type_id);
            $model->content = json_encode($request->content);;
            $model->status = $request->status;
            $model->update();
            return redirect('admin/library/' . $request->type_id . '/edit')->with('message', 'Data added Successfully');
        }
    }

    public function edit($id)
    {
        // if (!have_right('View-Library-Image') || !have_right('View-Library-Video') || !have_right('View-Library-Audio') || !have_right('View-Library-Book') || !have_right('View-Library-Document'))
        //     access_denied();

        $libraryType = LibraryType::where('id', $id)->first();
        $data = [];
        $data['id'] = $id;
        $data['row'] = Library::where('type_id', $id)->get();
        $data['action'] = 'edit';
        $data['languages'] = Language::all();
        $data['libraryType'] = $libraryType;

        return View('admin.library.form', $data);
    }

    public function uploadFile(Request $request)
    {
        $fileName = 'library' . time() . '.' . $request->file->extension();
        if ($request->file->move(public_path('images/lib_images_thumb'), $fileName)) {
            $path =  'images/lib_images_thumb/' . $fileName;
            return $path;
        }
    }

    public function deleteEditoImage($image)
    {
        if (file_exists(public_path($image))) {
            unlink(public_path($image));
        }
    }

    public function saveFilesAjax(Request $request)
    {
        if (isset($request->videUrl)) {
            $model = new Library();
            $type_id = request()->libId;
            $filePath = $request->videUrl;
            $model->file =  $filePath;
            $model->type_id =  $type_id;
            $model->type_video = 1;
            $model->status =  1;
            $model->save();

            return [
                'path' =>  $filePath,
                'libId' =>  $model->id,
                'filename' => ''
            ];
        }
        $receiver = new FileReceiver('file', $request, HandlerFactory::classFromRequest($request));
        if (!$receiver->isUploaded()) {
            // file not uploaded
            echo "file is not uploaded";
        }

        $fileReceived = $receiver->receive(); // receive file
        if ($fileReceived->isFinished()) { // file uploading is complete / all chunks are uploaded
            $file = $fileReceived->getFile(); // get file
            $extension = $file->getClientOriginalExtension();
            $fileName = str_replace('.' . $extension, '', $file->getClientOriginalName()); //file name without extenstion
            $fileName .= '_' . md5(time()) . '.' . $extension; // a unique file name
            $disk = Storage::disk(config('filesystems.default'));
            $disk->putFileAs('public/lib-files', $file, $fileName);
            $pathLib = 'storage/lib-files/' . $fileName;
            $path = asset('storage/lib-files/' . $fileName);

            $model = new Library();
            $type_id = request()->libId;
            $filePath = $pathLib;
            $model->file =  $filePath;
            $model->type_id =  $type_id;
            $model->status =  1;
            $model->save();


            // delete chunked file
            unlink($file->getPathname());
            return [
                'path' =>  $path,
                'libId' =>  $model->id,
                'filename' => $fileName
            ];
        }

        // otherwise return percentage information
        $handler = $fileReceived->handler();
        return [
            'done' => $handler->getPercentageDone(),
            'status' => true
        ];
    }
    public function updateThumbImg(Request $request)
    {
        $id = $request->id;
        $model = Library::find($id);
        $filePath = $this->uploadFile($request);
        $model->img_thumb_nail = $filePath;
        $model->update();
    }
}
