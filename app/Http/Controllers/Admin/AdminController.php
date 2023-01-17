<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Admin\Admin;
use App\Models\Admin\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Hash;
use Auth;
use DB;
use DataTables;
use Hashids\Hashids;

class AdminController extends Controller
{
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        if(!have_right('Access-Admin'))
            access_denied();

        $data = [];
        $hashids = new Hashids('',10);

        if($request->ajax())
        {
            $db_record = Admin::whereNotIn('id', [1, auth()->user()->id]);
            
            $db_record = $db_record->orderBy('created_at','DESC')->get();
            $datatable = Datatables::of($db_record);
            $datatable = $datatable->addIndexColumn();
            $datatable = $datatable->addColumn('role', function($row)
            {
                return isset($row->role->name)?$row->role->name : '';
            });
            $datatable = $datatable->addColumn('name', function($row)
            {
                return $row->first_name . ' ' . $row->last_name;
            });
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

                if(have_right('Access-Admin'))
                {
                    $actions .= '<a class="btn btn-primary" href="'.url("admin/admins/" .$hashids->encode($row->id).'/edit').'" title="Edit"><i class="far fa-edit"></i></a>';
                }
                    
                if(have_right('Access-Admin'))
                {
                    $actions .= '<form method="POST" action="'.url("admin/admins/" . $hashids->encode($row->id)).'" accept-charset="UTF-8" style="display:inline;">';
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

            $datatable = $datatable->rawColumns(['status','action','name']);
            $datatable = $datatable->make(true);
            return $datatable;
        }

        

        return view('admin.admins.listing',$data);
    }

    public function create()
    {
        if(!have_right('Access-Admin'))
            access_denied();

        $data = [];
        $data['roles'] = Role::where('status',1)->get();
        $data['row'] = new Admin();
        $data['action'] = 'add';
        return View('admin.admins.form',$data);
    }

    public function edit($id)
    {
        if(!have_right('Access-Admin'))
            access_denied();

        $data = [];
        $data['id'] = $id;
        $hashids = new Hashids('',10);
        $id = $hashids->decode($id)[0];
        $data['roles'] = Role::where('status',1)->get();
        $data['row'] = Admin::find($id);
        $data['action'] = 'edit';
        return View('admin.admins.form',$data);
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
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'phone' => 'required|string|max:100',
            'password' => 'required|string|min:8|max:30',
        ]);

        if ($validator->fails())
        {
            Session::flash('flash_danger', $validator->messages());
            return redirect()->back()->withInput();
        }

        if($input['action'] == 'add')
        {
            if(!have_right('Access-Admin'))
                access_denied();

            $model = new Admin();
            $model->fill($input);
            $model->save();

            return redirect('admin/admins')->with('message','Data added Successfully');
        }
        else
        {
            if(!have_right('Access-Admin'))
                access_denied();

            $id = $input['id'];
            $hashids = new Hashids('',10);
            $id = $hashids->decode($id)[0];
            $model = Admin::find($id);
            $model->fill($input);
            $model->update();
            return redirect('admin/admins')->with('message','Data updated Successfully');
        }
    }

    public function destroy($id)
    {
        if(!have_right('Access-Admin'))
            access_denied();

        $data = [];
        $hashids = new Hashids('',10);
        $id = $hashids->decode($id)[0];
        $data['row'] = Admin::destroy($id);
        return redirect('admin/admins')->with('message','Data deleted Successfully');
    }

    //________________Admin Update Profile_____________//
    public function profile()
    {
        if (\Request::isMethod('post')) {
            unset($_POST['_token']);
            $data = $_POST;
            // dd($data);
            if (isset($data['password']) && !empty($data['password'])) {
                $hashedPassword = Auth::user()->password;
                if (!\Hash::check($data['old_password'], $hashedPassword)) {
                    return redirect()->back()->withInput()->with('error', 'Old Password Is Not Correct');
                } else {
                    unset($data['old_password']);
                    unset($data['confirm_password']);
                    $data['origional_password'] = $data['password'];
                    $data['password'] = Hash::make($data['password']);
                }
            } else {
                unset($data['password']);
                unset($data['old_password']);
                unset($data['confirm_password']);
            }
            $id = auth()->user()->id;
            $admin = Admin::find($id);
            $admin->fill($data);
            $admin->save();
            return redirect()->back()->withInput()->with('message', 'Save Record Successfully');
        }
        $user = auth()->user();
        return View('admin.admins.profile', $user);
    }
    public function profilePic(Request $request)
    {
        $input = $request->all();
        $id = Auth::user()->id;
        $model = Admin::find($id);
        if (isset($input['image'])) {
            $imagePath = $this->uploadimage($request);
            $input['profile'] = $imagePath;
        }
        unset($input['image']);
        $model->fill($input);
        if ($model->update()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * upload the image .
     *
     */
    public function uploadimage(Request $request)
    {
        $path = '';
        if ($request->image) {
            $imageName = 'profile' . time() . '.' . $request->image->extension();
            if ($request->image->move(public_path('images/profile'), $imageName)) {
                $path =  'images/profile/' . $imageName;
            }
        }
        return $path;
    }
}