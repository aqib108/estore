<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\News;
use App\Models\Admin\Language;
use Illuminate\Support\Facades\Validator;
use Session;
use DataTables;
use Hashids\Hashids;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!have_right('View-Ceo-Message'))
            access_denied();
        $data = [];
        if ($request->ajax()) {
            $db_record = News::orderBy('created_at', 'DESC')->get();
            $datatable = DataTables::of($db_record);
            $datatable = $datatable->addIndexColumn();
            $datatable = $datatable->editColumn('title', function($row)
            {
                
                $title = json_decode($row->title);
                return $title->en;
            });
            $datatable = $datatable->editColumn('author_name', function($row)
            {
                $author_name = json_decode($row->author_name);
                return $author_name->en;
            });
            $datatable = $datatable->editColumn('status', function ($row) {
                $status = '<span class="badge badge-danger">Disable</span>';
                if ($row->status == 1) {
                    $status = '<span class="badge badge-success">Active</span>';
                }
                return $status;
            });
            $datatable = $datatable->addColumn('action', function ($row) {
                $actions = '<span class="actions">';

                if (have_right('Edit-Ceo-Message')) {
                    $actions .= '<a class="btn btn-primary" href="' . url("admin/news/" . $row->id . '/edit') . '" title="Edit"><i class="far fa-edit"></i></a>';
                }

                if (have_right('Delete-Ceo-Message')) {
                    $actions .= '<form method="POST" action="' . url("admin/news/" . $row->id) . '" accept-charset="UTF-8" style="display:inline;">';
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
        return view('admin.news-feeds.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!have_right('Create-Ceo-Message'))
            access_denied();
        $data = [];
        $data['row'] = new News();
        $data['action'] = 'add';
        $data['languages'] = Language::all();
        return View('admin.news-feeds.form', $data);
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
        if($input['action'] == 'add')
        {
        $input['title'] = json_encode($request->title);
        $input['content'] = json_encode($request->content); 
        $input['author_name'] = json_encode($request->author_name);
        $input['location'] = json_encode($request->location);  
        $model = new News();
        $model->fill($input);
        $model->save();
        return redirect('admin/news')->with('message','Data saved Successfully');
        }
        else
        {
            if(!have_right('edit-admin') || 0)
                access_denied();

           
            $id = $input['id'];
        
            $model = News::find($id);
            $input['title'] = json_encode($request->title);
        $input['content'] = json_encode($request->content); 
        $input['author_name'] = json_encode($request->author_name);
        $input['location'] = json_encode($request->location);  
           
            $model->fill($input);
            $model->update();
            return redirect('admin/news')->with('message','Data update Successfully');
           
           
        }
       
       
    }

   
    public function edit($id)
    {
        if(!have_right('edit-customer'))
        access_denied();

    $data = [];
    $data['id'] = $id;
    $data['row'] = news::find($id);
    $data['languages'] = Language::all();
    $data['action'] = 'edit';
    return View('admin.news-feeds.form',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!have_right('delete-admin'))
        access_denied();

        $data = [];
        $data['row'] = News::destroy($id);
        return redirect('admin/news')->with('message','Data deleted Successfully');
    }
}
