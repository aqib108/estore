<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Admin\OurAims;
use App\Models\Admin\Language;
use Illuminate\Http\Request;
use Session;
use DataTables;
use Hash;
use Auth;
use DB;
use Hashids\Hashids;
class AimsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!have_right('Access-User'))
        access_denied();

    $data = [];
    $hashids = new Hashids('',10);
    if($request->ajax())
    {
        $db_record = OurAims::all();
        $datatable = Datatables::of($db_record);
        $datatable = $datatable->addIndexColumn();
    
        $datatable = $datatable->editColumn('title', function($row)
        {
            $title = json_decode($row->title);
            return $title->en;
        });
        
        $datatable = $datatable->addColumn('action', function($row) use($hashids)
        {
            $actions = '<span class="actions">';

            if(have_right('Access-User'))
            {
                $actions .= '&nbsp;<a class="btn btn-primary" href="'.url("admin/aims/" .$hashids->encode($row->id).'/edit').'" title="Edit"><i class="far fa-edit"></i></a>';
            }
                
            if(have_right('Access-User'))
                {
                    $actions .= '<form method="POST" action="'.url("admin/aims/" . $hashids->encode($row->id)).'" accept-charset="UTF-8" style="display:inline;">';
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
        return view('admin.Aims.listing',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!have_right('Access-User'))
            access_denied();
        $data = [];
        $data['row'] = new OurAims();
        $data['action'] = 'add';
        $data['languages'] = Language::all();
        return View('admin.aims.form', $data);
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
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($validator->fails())
        {
            Session::flash('flash_danger', $validator->messages());
            return redirect()->back()->withInput();
        }
        if($input['action'] == 'add')
        {
        $input['title'] = json_encode($request->title);
        $input['content'] = json_encode($request->content);
        if($request->hasFile('image'))
            {
                
                    $input['file'] = $this->uploadfile($request);   
            }
        $model = new OurAims();
        $model->fill($input);
        $model->save();
        return redirect('admin/aims')->with('message','Data saved Successfully');
        }
        else
        {
            if(!have_right('Access-User') || 0)
                access_denied();
                $hashids = new Hashids('',10);
                $id = $input['id'];
                $id = $hashids->decode($id)[0];
            $model = OurAims::find($id);
            $input['title'] = json_encode($request->title);
            $input['content'] = json_encode($request->content);
            if (isset($input['image'])) {
                $filePath = $this->uploadfile($request);
                $model->file= $filePath;
                $file_url =  $model->file;
                if (file_exists(public_path($file_url))) {
                    if(isset($file_url))
                    unlink($file_url);
                }
            } else {
                unset($input['image']);
            }
            $model->fill($input);
            $model->update();
            return redirect('admin/aims')->with('message','Data update Successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadfile(Request $request)
    {
        $path = '';
        if ($request->image) {
            $fileName = 'our-aims-images' . time() . '.' . $request->image->extension();
            if ($request->image->move(public_path('our-aims-images'), $fileName)) {
                $path =  'our-aims-images/' . $fileName;
            }
        }
        return $path;
    }
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
        if (!have_right('Access-User'))
        access_denied();

        $hashids = new Hashids('',10);
        $data = [];
        $data['id'] = $id;
        $id = $hashids->decode($id)[0];
    $data['row'] = OurAims::find($id);
    $data['action'] = 'edit';
    $data['languages'] = Language::all();
    return View('admin.aims.form', $data);
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
        if(!have_right('Access-User') || 0)
        access_denied();

    $data = [];
    $hashids = new Hashids('',10);
    $id = $hashids->decode($id)[0];
    $data['row'] = OurAims::destroy($id);
    return redirect('admin/aims')->with('message','Data deleted Successfully');
    }
}
