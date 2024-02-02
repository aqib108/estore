<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Slider;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Http\Request;
use DataTables;


class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!have_right('View-Slider'))
            access_denied();

        $data = [];
        if ($request->ajax()) {
            $db_record = Slider::orderBy('created_at', 'DESC')->get();
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

                if (have_right('Edit-Slider')) {
                    $actions .= '<a class="btn btn-primary" href="' . url("admin/slider/" . $row->id . '/edit') . '" title="Edit"><i class="far fa-edit"></i></a>';
                }

                if (have_right('Delete-Products')) {
                    $actions .= '<form method="POST" action="' . url("admin/slider/" . $row->id) . '" accept-charset="UTF-8" style="display:inline;">';
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
        return view('admin.slider.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!have_right('Create-Slider'))
            access_denied();
        $data = [];
        $data['row'] = new Slider;
        $data['action'] = 'add';
        return View('admin.slider.form', $data);
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
            'name' => 'required',
            'image' => 'mimes:jpeg,png,jpg',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('flash_danger', $validator->messages());
            return redirect()->back()->withInput();
        }
        $url_image = array();


        if ($input['action'] == 'add') {
            if (!have_right('Create-Slider'))
                access_denied();

            if (isset($input['image'])) {
                $imagePath = $this->uploadimage($request);
                $input['image'] = $imagePath;
            }
            $input['admin_id'] = auth()->user()->id;
            $model = new Slider();
            $model->fill($input);
            $model->save();

            return redirect('admin/slider')->with('message', 'Data added Successfully');
        } else {
            if (!have_right('Edit-Slider'))
                access_denied();

            $id = $input['id'];
            $model = Slider::find($id);
            // @for delete images
            if (isset($input['image'])) {
                $imagePath = $this->uploadimage($request);
                $input['image'] = $imagePath;
                $image_url =  $model->image;
                if (file_exists(public_path($image_url))) {
                    unlink($image_url);
                }
            } else {
                unset($input['image']);
            }
            // @for delete images
            $model->fill($input);
            $model->update();
            return redirect('admin/slider')->with('message', 'Data updated Successfully');
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
        if (!have_right('Edit-Slider'))
            access_denied();

        $data = [];
        $data['id'] = $id;
        // $id = Hashids::decode($id)[0];
        $data['row'] = Slider::find($id);
        $data['action'] = 'edit';
        return View('admin.slider.form', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!have_right('Delete-Slider'))
            access_denied();

        $model = Slider::find($id);
        $image_url =  $model->image;
        if (file_exists(public_path($image_url))) {
            unlink($image_url);
        }
        $data = [];
        $data['row'] = Slider::destroy($id);
        return redirect('admin/slider')->with('message', 'Data deleted Successfully');
    }

    /**
     * upload the image .
     *
     */
    public function uploadimage(Request $request)
    {
        $path = '';
        if ($request->image) {
            $imageName = 'slider' . time() . '.' . 'webp';
            if ($request->image->move(public_path('images/slider'), $imageName)) {
                $path =  'images/slider/' . $imageName;
            }
        }
        return $path;
    }
}
