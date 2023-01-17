<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\CeoMessage;
use App\Models\Admin\Language;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Http\Request;
use DataTables;


class CeoMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd("test");
        // dd($request->ipinfo->all);
        if (!have_right('Access-Message'))
            access_denied();
        $data = [];
        if ($request->ajax()) {
            $db_record = CeoMessage::orderBy('created_at', 'DESC')->get();
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

                if (have_right('Access-Message')) {
                    $actions .= '<a class="btn btn-primary" href="' . url("admin/ceomessage/" . $row->id . '/edit') . '" title="Edit"><i class="far fa-edit"></i></a>';
                }

                if (have_right('Access-Message')) {
                    $actions .= '<form method="POST" action="' . url("admin/ceomessage/" . $row->id) . '" accept-charset="UTF-8" style="display:inline;">';
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

            $datatable = $datatable->rawColumns(['status', 'action']);
            $datatable = $datatable->make(true);
            return $datatable;
        }
        return view('admin.ceo-message.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!have_right('Access-Message'))
            access_denied();
        $data = [];
        $data['row'] = new CeoMessage;
        $data['action'] = 'add';
        $data['languages'] = Language::all();
        return View('admin.ceo-message.form', $data);
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
            'message_title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            Session::flash('flash_danger', $validator->messages());
            return redirect()->back()->withInput();
        }
        $url_image = array();


        if ($input['action'] == 'add') {
            if (!have_right('Access-Message'))
                access_denied();
            $model = new CeoMessage();
            if (isset($input['image'])) {
                $imagePath = $this->uploadimage($request);
                $model->image=$imagePath;
            }
            $model->message=json_encode($request->message);
            $model->message_title=$request->message_title;
            $model->status=$request->status;
            $model->save();
            return redirect('admin/ceomessage')->with('message', 'Data added Successfully');
        } else {

            if (!have_right('Access-Message'))
                access_denied();

            $id = $input['id'];
            $model = CeoMessage::find($id);
            // @for delete images
            if (isset($input['image'])) {
                $imagePath = $this->uploadimage($request);
                $model->image=$imagePath;
                $image_url =  $model->image;
                if (file_exists(public_path($image_url))) {
                    unlink($image_url);
                }
            } else {
                unset($input['image']);
            }
            $model->message=json_encode($request->message);
            $model->message_title=$request->message_title;
            $model->status=$request->status;
            $model->update();
            return redirect('admin/ceomessage')->with('message', 'Data updated Successfully');
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
        if (!have_right('Access-Message'))
            access_denied();

        $data = [];
        $data['id'] = $id;
        // $id = Hashids::decode($id)[0];
        $data['row'] = CeoMessage::find($id);
        $data['action'] = 'edit';
        $data['languages'] = Language::all();
        return View('admin.ceo-message.form', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!have_right('Access-Message'))
            access_denied();
        $model = CeoMessage::find($id);
        $image_url =  $model->image;
        if (file_exists(public_path($image_url))) {
            unlink($image_url);
        }
        $data = [];
        $data['row'] = CeoMessage::destroy($id);
        return redirect('admin/ceomessage')->with('message', 'Data deleted Successfully');
    }
    public function uploadimage(Request $request)
    {
        $path = '';
        if ($request->image) {
            $imageName = 'ceo-message' . time() . '.' . $request->image->extension();
            if ($request->image->move(public_path('images/ceo-message'), $imageName)) {
                $path =  'images/ceo-message/' . $imageName;
            }
        }
        return $path;
    }
}
