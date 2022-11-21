<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Admin\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Hash;
use Auth;
use DB;
use DataTables;
use Hashids\Hashids;

class CustomerController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        if(!have_right('view-customers'))
            access_denied();

        $data = [];
        $hashids = new Hashids('',10);
        if($request->ajax())
        {
            $db_record = User::all();

            $datatable = Datatables::of($db_record);
            $datatable = $datatable->addIndexColumn();
           
            $datatable = $datatable->editColumn('status', function($row)
            {
                $status = '<span class="badge badge-danger">Disable</span>';
                if ($row->status == 1)
                {
                    $status = '<span class="badge badge-success">Active</span>';
                }
                return $status;
            });
            $datatable = $datatable->addColumn('action', function($row) use($hashids)
            {
                $actions = '<span class="actions">';

                if(have_right('edit-customer'))
                {
                    $actions .= '&nbsp;<a class="btn btn-primary" href="'.url("admin/customers/" .$hashids->encode($row->id).'/edit').'" title="Edit"><i class="far fa-edit"></i></a>';
                }
                    
                if(have_right('delete-customer'))
                {
                    $actions .= '<form method="POST" action="'.url("admin/customers/" . $row->id).'" accept-charset="UTF-8" style="display:inline;">';
                    $actions .= '<input type="hidden" name="_method" value="DELETE">';
                    $actions .= '<input name="_token" type="hidden" value="'.csrf_token().'">';
                    $actions .= '<button class="btn btn-danger" style="margin-left:02px;" onclick="return confirm(\'Are you sure you want to delete this record?\');" title="Delete">';
                    $actions .= '<i class="far fa-trash-alt"></i>';
                    $actions .= '</button>';
                    $actions .= '</form>';                    
                }
                
                $actions .= '</span>';
                return $actions;
            });

            $datatable = $datatable->rawColumns(['status','action']);
            $datatable = $datatable->make(true);
            return $datatable;
        }

        return view('admin.customers.listing',$data);
    }

    public function create()
    {
        if(!have_right('add-customer'))
            access_denied();

        $data = [];
        $data['row'] = new User();
        $data['action'] = 'add';
        return View('admin.customers.form',$data);
    }

    public function edit($id)
    {
        if(!have_right('edit-customer'))
            access_denied();

        $data = [];
        $data['id'] = $id;
        $hashids = new Hashids('',10);
        $id = $hashids->decode($id)[0];
        $data['row'] = User::find($id);
        $data['action'] = 'edit';
        return View('admin.customers.form',$data);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        
        if(isset($input['password']) || isset($input['origional_password']))
        {
            $input['password'] = Hash::make($input['password']);
            $input['origional_password'] = $input['repeat_password'];
        }
        else
        {
            unset($input['password'],$input['origional_password']);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:200',
            'email' => 'required|string|max:100',
        ]);

        if ($validator->fails())
        {
            Session::flash('flash_danger', $validator->messages());
            return redirect()->back()->withInput();
        }

        if($input['action'] == 'add')
        {
            if(!have_right('add-customer'))
                access_denied();

            $model = new User();
            $model->fill($input);
            $model->save();

            return redirect('admin/customers')->with('message','Data added Successfully');
        }
        else
        {
            if(!have_right('edit-customer'))
                access_denied();

            $id = $input['id'];
            $hashids = new Hashids('',10);
            $id = $hashids->decode($id)[0];
            $model = User::find($id);
            $model->fill($input);
            $model->update();
            return redirect('admin/customers')->with('message','Data updated Successfully');
        }
    }

    public function destroy($id)
    {
        if(!have_right('delete-customer'))
            access_denied();

        $data = [];
        $hashids = new Hashids('',10);
        $id = $hashids->decode($id)[0];
        $data['row'] = User::destroy($id);
        return redirect('admin/customers')->with('message','Data deleted Successfully');
    }
}