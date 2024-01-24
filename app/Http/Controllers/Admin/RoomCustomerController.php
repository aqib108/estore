<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Department;
use App\Models\Admin\Room;
use App\Models\Admin\Customer;
use App\Models\Admin\Language;
use Hash;
use DataTables;
use Hashids\Hashids;
class RoomCustomerController extends Controller
{
    protected $model ;
    public function __construct(Customer $customer){
       $this->model = $customer;
    }
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
        $db_record = $this->model::all();
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
        $datatable = $datatable->editColumn('name', function($row)
        {
            return $row->name;
            
        });
        $datatable = $datatable->editColumn('customer_no', function($row)
        {
            return $row->customer_no;
            
        });
        $datatable = $datatable->editColumn('address', function($row)
        {
            return $row->address;
        });
        $datatable = $datatable->addColumn('action', function($row) use($hashids)
        {
            $actions = '<span class="actions">';

            
                $actions .= '&nbsp;<a class="btn btn-primary" href="'.url("admin/customers/" .$hashids->encode($row->id).'/edit').'" title="Edit"><i class="far fa-edit"></i></a>';
            
                
            
                    $actions .= '<form method="POST" action="'.url("admin/customers/" . $hashids->encode($row->id)).'" accept-charset="UTF-8" style="display:inline;">';
                    $actions .= '<input type="hidden" name="_method" value="DELETE">';
                    $actions .= '<input name="_token" type="hidden" value="'.csrf_token().'">';
                    $actions .= '<button class="btn btn-danger" style="margin-left:02px;" onclick="return confirm(\'Are you sure you want to delete this record?\');" title="Delete">';
                    $actions .= '<i class="far fa-trash-alt"></i>';
                    $actions .= '</button>';
                    $actions .= '</form>';
                
            $actions .= '</span>';
            return $actions;
        });

        $datatable = $datatable->rawColumns(['status','action']);
        $datatable = $datatable->make(true);
        return $datatable;
    }
        return view('admin.customer.listing',$data);
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
        $data['row'] = $this->model;
        $data['action'] = 'add';
        return View('admin.customer.form',$data);
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
        $input['name'] = $request->name;
        $input['mobile_no'] = $request->mobile_no;
        $input['nid'] = $request->nid;
        $input['address'] = $request->address;
        if($request->hasFile('image'))
            {
                $timageName = 'customers-image'.time().'.'.$request->image->extension();  
                if($request->image->move(public_path('customers-image/'), $timageName))
                {
                    $input['image'] = $timageName;
                }   
            }
        $model = new $this->model;
        $model->fill($input);
        if($model->save()){
            $lastCreatedRoom = $this->model::latest()->first();
            $lastCreatedRoom->customer_no = Customer::$customerNumberPrefix.$lastCreatedRoom->id;
            $lastCreatedRoom->save();
        }
        
        return redirect('admin/customers')->with('message','Data saved Successfully');
        }
        else
        {
            // if(!have_right('Access-Our-Departments') || 0)
            //     access_denied();

            $hashids = new Hashids('',10);
            $id = $input['id'];
            $id = $hashids->decode($id)[0];
            $model = $this->model::find($id);
            $input['name'] = $request->name;
            $input['mobile_no'] = $request->mobile_no;
            $input['nid'] = $request->nid;
            $input['address'] = $request->address;
            if($request->hasFile('image'))
            {
                $timageName = 'customers-image'.time().'.'.$request->image->extension();  
                if($request->image->move(public_path('customers-image/'), $timageName))
                {
                    $input['image'] = $timageName;
                }   
            }
            $model->fill($input);
            $model->update();
            return redirect('admin/customers')->with('message','Data update Successfully');
           
           
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
        // if(!have_right('Access-Our-Departments'))
        //     access_denied();

        $data = [];
        $data['id'] = $id;
        $hashids = new Hashids('',10);
        $id = $hashids->decode($id)[0];
        $data['row'] = $this->model::find($id);
        $data['action'] = 'edit';
        return View('admin.customer.form',$data);
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
        // if(!have_right('Access-Our-Departments'))
        // access_denied();

        $data = [];
        $hashids = new Hashids('',10);
        $id = $hashids->decode($id)[0];
        $data['row'] = $this->model::destroy($id);
        return redirect('admin/customers')->with('message','Data deleted Successfully');
    }
}
