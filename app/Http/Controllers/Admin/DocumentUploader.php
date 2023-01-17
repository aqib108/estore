<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\DocumentUploader as DocumentModel;
use App\Models\Admin\Language;
use Hash;
use DataTables;
use Hashids\Hashids;

class DocumentUploader extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if(!have_right('Access-Our-Departments'))
        // access_denied();

    $data = [];
    $hashids = new Hashids('',10);
    if($request->ajax())
    {
        $db_record = DocumentModel::all();
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
        $datatable = $datatable->editColumn('path', function($row)
        {
            return env('APP_URL').'/download/'.$row->document_id;
        });
        // $datatable = $datatable->editColumn('description', function($row)
        // {
        //     $description = json_decode($row->description);
        //     return strip_tags($description->en);
        // });
        $datatable = $datatable->addColumn('action', function($row) use($hashids)
        {
            $actions = '<span class="actions">';

            // if(have_right('Access-Our-Departments'))
            // {
                $actions .= '&nbsp;<a class="btn btn-primary" href="'.url("admin/document-uploader/" .$hashids->encode($row->id).'/edit').'" title="Edit"><i class="far fa-edit"></i></a>';
            // }
                
            // if(have_right('Access-Our-Departments'))
            //     {
                    $actions .= '<form method="POST" action="'.url("admin/document-uploader/" . $hashids->encode($row->id)).'" accept-charset="UTF-8" style="display:inline;">';
                    $actions .= '<input type="hidden" name="_method" value="DELETE">';
                    $actions .= '<input name="_token" type="hidden" value="'.csrf_token().'">';
                    $actions .= '<button class="btn btn-danger" style="margin-left:02px;" onclick="return confirm(\'Are you sure you want to delete this record?\');" title="Delete">';
                    $actions .= '<i class="far fa-trash-alt"></i>';
                    $actions .= '</button>';
                    $actions .= '</form>';
                // }
            
            $actions .= '</span>';
            return $actions;
        });

        $datatable = $datatable->rawColumns(['status','action']);
        $datatable = $datatable->make(true);
        return $datatable;
    }
        return view('admin.document-uploader.listing',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(!have_right('Access-Our-Departments'))
        //     access_denied();

        $data = [];
        $data['row'] = new DocumentModel();
        $data['languages'] = Language::all();
        $data['action'] = 'add';
        return View('admin.document-uploader.form',$data);
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
        
            if($request->hasFile('file'))
            {
               $input['path'] = $this->uploadfile($request);   
            }
        $input['document_id'] = uniqid();
        $model = new DocumentModel();
        $model->fill($input);
        $model->save();
        return redirect('admin/document-uploader')->with('message','Data saved Successfully');
        }
        else
        {
            // if(!have_right('Access-Our-Departments') || 0)
            //     access_denied();

            $hashids = new Hashids('',10);
            $id = $input['id'];
            $id = $hashids->decode($id)[0];
            $model = DocumentModel::find($id);
            
            if (isset($input['file'])) {
                $filePath = $this->uploadfile($request);
                $model->file= $filePath;
                $file_url =  $model->path;
                if (file_exists(public_path($file_url))) {
                    if(isset($file_url))
                       unlink($file_url);
                }
            } else {
                unset($input['file']);
            }
            $model->fill($input);
            $model->update();
            return redirect('admin/document-uploader')->with('message','Data update Successfully');      
        }
       
    }
    public function uploadfile(Request $request)
    {
        $path = '';
        if ($request->file) {
            $fileName = 'document-uploader' . time() . '.' . $request->file->extension();
            if ($request->file->move(public_path('files/document-uploader'), $fileName)) {
                $path =  'files/document-uploader/' . $fileName;
            }
        }
        return $path;
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
        // if(!have_right('Access-Our-Departments'))
        //     access_denied();

        $data = [];
        $data['id'] = $id;
        $hashids = new Hashids('',10);
        $id = $hashids->decode($id)[0];
        $data['action'] = 'edit';
        $data['row'] = DocumentModel::find($id);
        $data['languages'] = Language::all();
        return View('admin.document-uploader.form',$data);
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
        if(!have_right('Access-Our-Departments'))
        access_denied();

        $data = [];
        $hashids = new Hashids('',10);
        $id = $hashids->decode($id)[0];
        $data['row'] = Department::destroy($id);
        return redirect('admin/department')->with('message','Data deleted Successfully');
    }
}
