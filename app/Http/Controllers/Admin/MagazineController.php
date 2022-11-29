<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Magazine;
use App\Models\Admin\Language;
use App\Models\Admin\MagazineCategory;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Http\Request;
use DataTables;

class MagazineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!have_right('View-Magazines'))
            access_denied();

        $data = [];
        if ($request->ajax()) {
            $db_record = Magazine::orderBy('created_at', 'DESC')->get();
            $datatable = Datatables::of($db_record);
            $datatable = $datatable->addIndexColumn();
            $datatable = $datatable->editColumn('title', function($row)
            {
                $title = (array)json_decode($row->title);
                return $title['en'];

            });
            $datatable = $datatable->editColumn('status', function ($row) {
                $status = '<span class="badge badge-danger">Disable</span>';
                if ($row->status == 1) {
                    $status = '<span class="badge badge-success">Active</span>';
                }
                return $status;
            });
            $datatable = $datatable->editColumn('statusColumn', function ($row) {
                if ($row->status == 1) {
                    $status = 'Active';
                } else {
                    $status = 'Disable';
                }
                return $status;
            });
            $datatable = $datatable->addColumn('action', function ($row) {
                $actions = '<span class="actions">';

                if (have_right('Edit-Magazines')) {
                    $actions .= '<a class="btn btn-primary" href="' . url("admin/magazines/" . $row->id . '/edit') . '" title="Edit"><i class="far fa-edit"></i></a>';
                }

                if (have_right('Delete-Magazines')) {
                    $actions .= '<form method="POST" action="' . url("admin/magazines/" . $row->id) . '" accept-charset="UTF-8" style="display:inline;">';
                    $actions .= '<input type="hidden" name="_method" value="DELETE">';
                    $actions .= '<input name="_token" type="hidden" value="' . csrf_token() . '">';
                    $actions .= '<button class="btn btn-danger" style="margin-left:02px;" onclick="return confirm(\'Are you sure you want to delete this record?\');" title="Delete">';
                    $actions .= '<i class="far fa-trash-alt"></i>';
                    $actions .= '</button>';
                    $actions .= '</form>';
                }

                $actions .= '</span>';
                return $actions;
            });

            $datatable = $datatable->rawColumns(['status','statusColumn', 'action']);
            $datatable = $datatable->make(true);
            return $datatable;
        }
        return view('admin.magazines.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!have_right('Create-Magazines'))
            access_denied();
        $data = [];
        $data['row'] = new Magazine;
        $data['action'] = 'add';
        $data['languages'] = Language::all();
        $data['magazine_categories'] = MagazineCategory::where('status',1)->get();
        return View('admin.magazines.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'file' => 'mimes:pdf',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('flash_danger', $validator->messages());
            return redirect()->back()->withInput();
        }

        if ($input['action'] == 'add') {
            if (!have_right('Create-Magazines'))
                access_denied();
            $model = new Magazine();
            if (isset($input['file'])) {
                $filePath = $this->uploadfile($request);
                $model->file= $filePath;
            }
            if (isset($input['thumbnail_image'])) {
                $imagePath = $this->uploadimage($request);
                $model->thumbnail_image = $imagePath;
            }
            unset($input['action']);
            $model->title=json_encode($request->title);
            $model->description=json_encode($request->description);
            $model->magazine_category_id=$request->magazine_category_id;
            $model->status=$request->status;
            $model->save();

            return redirect('admin/magazines')->with('message', 'Data added Successfully');
        } else {
            if (!have_right('Edit-Magazines'))
                access_denied();

            $id = $input['id'];
            $model = Magazine::find($id);
            // @for delete files
            if (isset($input['file'])) {
                $filePath = $this->uploadfile($request);
                $model->file= $filePath;
                $file_url =  $model->file;
                if (file_exists(public_path($file_url))) {
                    unlink($file_url);
                }
            } else {
                unset($input['file']);
            }
            if (isset($input['thumbnail_image'])) {
                $imagePath = $this->uploadimage($request);
                $model->image = $imagePath;
                $image_url =  $model->thumbnail_image;
                if (file_exists(public_path($image_url))) {
                    unlink($image_url);
                }
            } else {
                unset($input['file']);
            }
            // @for delete files
            unset($input['action']);
            $model->title=json_encode($request->title);
            $model->description=json_encode($request->description);
            $model->magazine_category_id=$request->magazine_category_id;
            $model->status=$request->status;
            $model->update();
            return redirect('admin/magazines')->with('message', 'Data updated Successfully');
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!have_right('Edit-Magazines'))
            access_denied();

        $data = [];
        $data['id'] = $id;
        // $id = Hashids::decode($id)[0];
        $data['row'] = Magazine::find($id);
        $data['languages'] = Language::all();
        $data['action'] = 'edit';
        $data['magazine_categories'] = MagazineCategory::where('status',1)->get();
        return View('admin.magazines.form', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!have_right('Delete-Magazines'))
            access_denied();

        $model = Magazine::find($id);
        $file_url =  $model->file;
        if (file_exists(public_path($file_url))) {
            unlink($file_url);
        }
        $data = [];
        $data['row'] = Magazine::destroy($id);
        return redirect('admin/magazines')->with('message', 'Data deleted Successfully');
    }
    public function uploadfile(Request $request)
    {
        $path = '';
        if ($request->file) {
            $fileName = 'magazine' . time() . '.' . $request->file->extension();
            if ($request->file->move(public_path('files/magazine'), $fileName)) {
                $path =  'files/magazine/' . $fileName;
            }
        }
        return $path;
    }

    public function uploadimage(Request $request)
    {
        $path = '';
        if ($request->thumbnail_image) {
            $imageName = 'magazine' . time() . '.' . 'webp';
            if ($request->thumbnail_image->move(public_path('images/magazine'), $imageName)) {
                $path =  'images/magazine/' . $imageName;
            }
        }
        return $path;
    }
}
