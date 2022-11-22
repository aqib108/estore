<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hashids\Hashids;
use App\Models\Admin\Slider;
use DataTables;
use App\Models\Admin\Language;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!have_right('view-admins'))
            access_denied();

        $data = [];
        $hashids = new Hashids('',10);
        if($request->ajax())
        {
            $db_record = Slider::orderBy('created_at','DESC')->get();

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
                    $actions .= '<a class="btn btn-primary" href="'.url("admin/sliders/" .$hashids->encode($row->id).'/edit').'" title="Edit"><i class="far fa-edit"></i></a>';
                }
                    
                if(have_right('delete-admin'))
                {
                    $actions .= '<form method="POST" action="'.url("admin/sliders/" . $hashids->encode($row->id)).'" accept-charset="UTF-8" style="display:inline;">';
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

        return view('admin.sliders.listing',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!have_right('add-admin'))
            access_denied();

        $data = [];
        $data['row'] = new Slider();
        $data['languages'] = Language::all();
        $data['action'] = 'add';
        return View('admin.sliders.form',$data);
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

        // $validator = Validator::make($request->all(), [
        //     'title' => 'required|string|max:255',
        //     'url' => 'required|string|max:255',
        // ]);

        // if ($validator->fails())
        // {
        //     Session::flash('flash_danger', $validator->messages());
        //     return redirect()->back()->withInput();
        // }

        if($input['action'] == 'add')
        {
            if(!have_right('add-admin'))
                access_denied();

            $model = new Slider();
            $model->name=json_encode($request->name);
            $model->content=json_encode($request->content);
            $model->status=$request->status;
            if($request->hasFile('image'))
            {
                $timageName = 'slider-'.time().'.'.$request->image->extension();  
                if($request->image->move(public_path('slider-images/'), $timageName))
                {
                    $model->image=$timageName;
                }   
            }
            $model->save();
            $msg = 'Data added Successfully';
        }
        // else
        // {
        //     if(!have_right('edit-admin'))
        //         access_denied();

        //     $id = $input['id'];
        //     $hashids = new Hashids('',10);
        //     $id = $hashids->decode($id)[0];
        //     $model = Post::find($id);
        //     $model->fill($input);
        //     $model->update();
        //     $msg = 'Data updated Successfully';
        // }

        return redirect('admin/posts')->with('message',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    public function uploadimage(Request $request)
    {
        $imageName = 'slider'.time().'.'.$request->image->extension();  
        if($request->image->move(public_path('sliders-images'), $imageName))
        {
            echo asset('sliders-images/'.$imageName);exit();
        }
    } 
}
