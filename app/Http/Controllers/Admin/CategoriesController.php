<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Admin\Category;
use App\Models\Admin\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Hash;
use Auth;
use DB;
use DataTables;
use Hashids\Hashids;

class CategoriesController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        if(!have_right('view-admins') || 0)
            access_denied();

        $hashids = new Hashids('',10);
        $data = [];
        if($request->ajax())
        {
            $db_record = Category::orderBy('created_at','DESC')->get();

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

                if(have_right('edit-admin'))
                {
                    $actions .= '<a class="btn btn-primary" href="'.url("admin/categories/" .$hashids->encode($row->id).'/edit').'" title="Edit"><i class="far fa-edit"></i></a>';
                }
                    
                if(have_right('delete-admin'))
                {
                    $actions .= '<form method="POST" action="'.url("admin/categories/" . $hashids->encode($row->id)).'" accept-charset="UTF-8" style="display:inline;">';
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

        return view('admin.categories.listing',$data);
    }

    public function create(Category $category)
    {
        if(!have_right('add-admin') || 0)
            access_denied();

        $data = [];
        $data['row'] = $category;
        $data['categories'] = $category->rootCategories();
        $data['action'] = 'add';
        return View('admin.categories.form',$data);
    }

    public function edit($id)
    {
        if(!have_right('edit-admin') || 0)
            access_denied();

        $hashids = new Hashids('',10);
        $data = [];
        $data['id'] = $id;
        $id = $hashids->decode($id)[0];
        $category = new Category();
        $data['row'] = Category::find($id);
        $data['categories'] = $category->rootCategories();
        $data['action'] = 'edit';
        return View('admin.categories.form',$data);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        if ($validator->fails())
        {
            Session::flash('flash_danger', $validator->messages());
            return redirect()->back()->withInput();
        }

        if(!isset($input['parent_id']))
        {
            $input['parent_id'] = null;
        }

        if($input['action'] == 'add')
        {
            if(!have_right('add-admin') || 0)
                access_denied();

            $model = new Category();
            $model->fill($input);
            $model->save();

            return redirect('admin/categories')->with('message','Data added Successfully');
        }
        else
        {
            if(!have_right('edit-admin') || 0)
                access_denied();

            $hashids = new Hashids('',10);
            $id = $input['id'];
            $id = $hashids->decode($id)[0];
            $model = Category::find($id);
            $model->fill($input);
            $model->update();
            return redirect('admin/categories')->with('message','Data updated Successfully');
        }
    }

    public function destroy($id)
    {
        if(!have_right('delete-admin') || 0)
            access_denied();

        $data = [];
        $hashids = new Hashids('',10);
        $id = $hashids->decode($id)[0];
        $data['row'] = Category::destroy($id);
        return redirect('admin/categories')->with('message','Data deleted Successfully');
    }
}