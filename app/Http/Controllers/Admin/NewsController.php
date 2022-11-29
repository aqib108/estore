<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\News;
use App\Models\Admin\Language;
use Illuminate\Support\Facades\Validator;
use Session;
use DataTables;

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
                    $actions .= '<a class="btn btn-primary" href="' . url("admin/ceomessage/" . $row->id . '/edit') . '" title="Edit"><i class="far fa-edit"></i></a>';
                }

                if (have_right('Delete-Ceo-Message')) {
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string|max:255',
            'auther_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            Session::flash('flash_danger', $validator->messages());
            return redirect()->back()->withInput();
        }
        $url_image = array();


        if ($input['action'] == 'add') {
            if (!have_right('Create-Ceo-Message'))
                access_denied();
            $model = new News();
            if (isset($input['image'])) {
                $imagePath = $this->uploadimage($request);
                $model->image=$imagePath;
            }
            $model->message=json_encode($request->title);
            $model->auther_name=json_encode($request->auther_name);
            $model->content=json_encode($request->content);
            $model->location=json_encode($request->location);
            $model->status=$request->status;
            $model->save();
            return redirect('admin/ceomessage')->with('message', 'Data added Successfully');
        } else {

            if (!have_right('Edit-Ceo-Message'))
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
}
