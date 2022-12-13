<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Admin\Page;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Hash;
use Auth;
use DB;
use DataTables;
use Hashids\Hashids;

class PagesController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        if(!have_right('view-admins'))
            access_denied();

        $data = [];
        $hashids = new Hashids('',10);
        if($request->ajax())
        {
            $db_record = Page::orderBy('created_at','DESC')->get();

            $datatable = Datatables::of($db_record);
            $datatable = $datatable->addIndexColumn();
            $datatable = $datatable->editColumn('title', function($row)
            {
                $title = (array)json_decode($row->title);
                return $title['en'];

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

                if(have_right('edit-admin'))
                {
                    $actions .= '<a class="btn btn-primary" href="'.url("admin/pages/" .$hashids->encode($row->id).'/edit').'" title="Edit"><i class="far fa-edit"></i></a>';
                }
                    
                if(have_right('delete-admin'))
                {
                    $actions .= '<form method="POST" action="'.url("admin/pages/" . $hashids->encode($row->id)).'" accept-charset="UTF-8" style="display:inline;">';
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

        return view('admin.pages.listing',$data);
    }

    public function create()
    {
        if(!have_right('add-admin'))
            access_denied();

        $data = [];
        $data['row'] = new Page();
        $data['action'] = 'add';
        return View('admin.pages.form',$data);
    }

    public function edit($id)
    {
        if(!have_right('edit-admin'))
            access_denied();

        $data = [];
        $data['id'] = $id;
        $hashids = new Hashids('',10);
        $id = $hashids->decode($id)[0];
        $data['row'] = Page::find($id);
        $data['action'] = 'edit';
        return View('admin.pages.form',$data);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $validator = Validator::make($request->all(), [
            'url' => 'required|string|max:255',
        ]);

        if ($validator->fails())
        {
            Session::flash('flash_danger', $validator->messages());
            return redirect()->back()->withInput();
        }

        if($input['action'] == 'add')
        {
            if(!have_right('add-admin'))
                access_denied();

            $input['admin_id'] = auth()->user()->id;
            $model = new Page();
            $model->title=json_encode($request->title);
            $model->short_description=json_encode($request->short_description);
            $model->description=json_encode($request->description);
            $model->url=$request->url;
            $model->in_header=$request->in_header;
            $model->in_footer=$request->in_footer;
            $model->status=$request->status;
            $model->meta_title=$request->meta_title;
            $model->meta_description=$request->meta_description;
            $model->meta_keywords=$request->meta_keywords;
            $model->admin_id=auth()->user()->id;
            $model->save();

            return redirect('admin/pages')->with('message','Data added Successfully');
        }
        else
        {
            if(!have_right('edit-admin'))
                access_denied();

            $id = $input['id'];
            $hashids = new Hashids('',10);
            $id = $hashids->decode($id)[0];
            $model = Page::find($id);
            $model->title=json_encode($request->title);
            $model->short_description=json_encode($request->short_description);
            $model->description=json_encode($request->description);
            $model->url=$request->url;
            $model->in_header=$request->in_header;
            $model->in_footer=$request->in_footer;
            $model->status=$request->status;
            $model->meta_title=$request->meta_title;
            $model->meta_description=$request->meta_description;
            $model->meta_keywords=$request->meta_keywords;
            $model->admin_id=auth()->user()->id;
            $model->update();
            return redirect('admin/pages')->with('message','Data updated Successfully');
        }
    }

    public function destroy($id)
    {
        if(!have_right('delete-admin'))
            access_denied();

        $data = [];
        $hashids = new Hashids('',10);
        $id = $hashids->decode($id)[0];
        $data['row'] = Page::destroy($id);
        return redirect('admin/pages')->with('message','Data deleted Successfully');
    }

    public function uploadimage(Request $request)
    {
        $imageName = 'page'.time().'.'.$request->image->extension();  
        if($request->image->move(public_path('pages-images'), $imageName))
        {
            echo asset('pages-images/'.$imageName);exit();
        }
    }   
}