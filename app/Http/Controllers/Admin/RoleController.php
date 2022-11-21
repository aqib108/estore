<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Session;
use Hashids\Hashids;
use Auth;
use DataTables;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!have_right('view-roles'))
            access_denied();

        $data = [];
        $hashids = new Hashids('',10);
        if($request->ajax())
        {
            $db_record = Role::orderBy('created_at','DESC');
            $datatable = Datatables::of($db_record);
            $datatable = $datatable->addIndexColumn();
            $datatable = $datatable->editColumn('status', function($row)
            {
                $status = '<span class="label label-danger">Disable</span>';
                if ($row->status == 1)
                {
                    $status = '<span class="label label-success">Active</span>';
                }
                return $status;
            });

            $datatable = $datatable->addColumn('action', function($row) use($hashids)
            {
                $actions = '<span class="actions">';

                if(have_right('edit-role') && $row->id != 1 && auth()->user()->role_id != $row->id)
                {
                    $actions .= '<a class="btn btn-primary" href="'.url("admin/roles/" . $hashids->encode($row->id).'/edit').'" title="Edit"><i class="far fa-edit"></i></a>';
                }

                if(have_right('delete-role') && $row->id != 1 && auth()->user()->role_id != $row->id)
                {
                    $actions .= '&nbsp;<form method="POST" action="'.url("admin/roles/" . $hashids->encode($row->id)).'" accept-charset="UTF-8" style="display:inline">';
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
        return view('admin.roles.listing',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!have_right('add-role'))
            access_denied();
        $data['row'] = new Role();
        $data['action'] = "Add";
        return view('admin.roles.form')->with($data);
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

        $input['right_ids'] = $request->has('right_ids') ? implode(",",$request->right_ids) : NULL;

        if($input['action'] == 'Add')
        {
            if(!have_right('add-role'))
                access_denied();

            $validator = Validator::make($request->all(), [
                'name' => ['required','string','max:100',Rule::unique('roles')]
            ]);

            $model = new Role();         
            $flash_message = 'Role has been created successfully.';
        }
        else
        {
            if(!have_right('edit-role'))
                access_denied();

            $hashids = new Hashids('',10);
            $input['id'] = $hashids->decode($input['id'])[0];
            $validator = Validator::make($request->all(), [
                'name' => ['required','string','max:100',Rule::unique('roles')->ignore($input['id'])]
            ]);
            $model = Role::findOrFail($input['id']);
            $flash_message = 'Role has been updated successfully.';
        }

        if ($validator->fails())
        {
            return redirect('admin/roles')->with('error',$validator->messages());
        }

        $model->fill($input);
        $model->save();

        if(auth()->user()->role_id == $model->id && $model->status == 0)
        {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.auth.login')->with('error' , 'Your role has been disabled.');
        }

        return redirect('admin/roles')->with('message',$flash_message);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!have_right('edit-role'))
            access_denied();
        
        
        if($id == 1)
            access_denied();

        $data['action'] = "Edit";
        $data['id'] = $id;
        $hashids = new Hashids('',10);
        $id = $hashids->decode($id)[0];
        $data['row'] = Role::findOrFail($id);
        return view('admin.roles.form')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!have_right('delete-role'))
            access_denied();
        
        $hashids = new Hashids('',10);
        $id = $hashids->decode($id)[0];

        if($id == 1)
            access_denied();

        $role = Role::find($id);
        if(count($role->admins) > 0)
        {
            return redirect('admin/roles')->with('message','You cannot delete this role because admin user(s) have already registered with this role.');
        }

        Role::destroy($id);
        return redirect('admin/roles')->with('message','Role has been deleted successfully.');
    }
}
