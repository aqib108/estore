<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Location;
use App\Models\Admin\Language;
use DataTables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
class LocationController extends Controller
{
    public function index(Request $request)
    {
        if (!have_right('View-Location'))
            access_denied();

        $data = [];
        if ($request->ajax()) {
            $db_record = Location::all();
            $datatable = Datatables::of($db_record);

            $datatable = $datatable->addIndexColumn();

            $datatable = $datatable->editColumn('status', function ($row) {
                $status = '<span class="badge badge-danger">Disable</span>';
                if ($row->status == 1) {
                    $status = '<span class="badge badge-success">Active</span>';
                }
                return $status;
            });
            $datatable = $datatable->editColumn('location_address', function($row)
            {
                $location_address = (array)json_decode($row->location_address);
                return $location_address['en'];

            });
            $datatable = $datatable->addColumn('featured', function ($row) {
                if ($row->featured == 1) {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }
                if (have_right('Featured-Location')) {

                    $featured = '<label class="switch"> <input type="checkbox" class="is_featured" id="chk_' . $row->id . '" name="is_featured" onclick="is_featured($(this),' . $row->id . ')" ' . $checked . ' > <span class="slider round"></span></label>';
                    return $featured;
                } else {
                    return '<span class=" badge badge-danger">No Permission</span>';
                }
            });
            $datatable = $datatable->addColumn('action', function ($row) {
                $actions = '<span class="actions">';

                if (have_right('Edit-Location')) {
                    $actions .= '&nbsp;<a class="btn btn-primary" href="' . url("admin/locations/" . $row->id) . '/edit' . '" title="Edit"><i class="far fa-edit"></i></a>';
                }

                if (have_right('Delete-Location')) {
                    $actions .= '<form method="POST" action="' . url("admin/locations/" . $row->id) . '" accept-charset="UTF-8" style="display:inline;">';
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

            $datatable = $datatable->rawColumns(['status','featured', 'action']);
            $datatable = $datatable->make(true);
            return $datatable;
        }

        return view('admin.locations.listing', $data);
    }

    public function create()
    {
        if (!have_right('Create-Location'))
            access_denied();

        $data = [];
        $data['row'] = new Location();
        $data['action'] = 'add';
        $data['languages'] = Language::all();
        return View('admin.locations.form', $data);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        if ($input['action'] == 'add') {
            unset($input['action']);
            if (!have_right('Create-Location'))
                access_denied();

            $model = new Location();
            $model->location_address=json_encode($request->location_address);
            $model->description=json_encode($request->description);
            $model->location_link=$request->location_link;
            $model->status=$request->status;
            $model->save();

            return redirect('admin/locations')->with('message', 'Data added Successfully');
        } else {
            if (!have_right('Edit-Location'))
                access_denied();

            unset($input['action']);
            $id = $input['id'];
            $model = Location::find($id);
            $model->location_address=json_encode($request->location_address);
            $model->description=json_encode($request->description);
            $model->location_link=$request->location_link;
            $model->status=$request->status;
            $model->update();
            return redirect('admin/locations')->with('message', 'Data updated Successfully');
        }
    }

    public function edit($id)
    {
        if (!have_right('Edit-Location'))
            access_denied();

        $data = [];
        $data['id'] = $id;
        $data['row'] = Location::find($id);
        $data['action'] = 'edit';
        $data['languages'] = Language::all();
        return View('admin.locations.form', $data);
    }

    public function destroy($id)
    {
        if (!have_right('Delete-Location'))
            access_denied();

        $data = [];
        // $id = Hashids::decode($id)[0];
        $data['row'] = Location::destroy($id);
        return redirect('admin/locations')->with('message', 'Data deleted Successfully');
    }
    public function setFeaturedAddress($id = null)
    {
        if (!have_right('Featured-Location'))
            access_denied();
            Location::where('featured', 1)->update(['featured' => 0]);
        $update_product = Location::where('id', $id)->update(['featured' => $_GET['status']]);

        if ($update_product) {

            echo true;
            exit();
        }
    }
}
