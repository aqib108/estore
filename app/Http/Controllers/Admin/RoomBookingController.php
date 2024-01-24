<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Admin\Customer;
use App\Models\Admin\Room;
use App\Models\Admin\RoomBooking;
use App\Models\Admin\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Hash;
use Auth;
use DB;
use DataTables;
use Hashids\Hashids;

class RoomBookingController extends Controller
{
  protected $model ;
  public function __construct(RoomBooking $roomBooking){
     $this->model = $roomBooking;
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function fetchRooms() 
  {
     return Room::whereStatus(1)->get();
  }
  public function fetchCustomers() 
  {
     return Customer::whereStatus(1)->get();
  }
  public function index(Request $request)
  {
      // if(!have_right('Access-Our-Departments'))
      // access_denied();

  $data = [];
  $hashids = new Hashids('',10);
  if($request->ajax())
  {
      $db_record = 
      $db_record = $this->model->join('rooms as ro','room_booking.room_id','ro.id')
      ->join('customers as cu','room_booking.customer_id','cu.id')
      ->select('room_booking.id as id','room_booking.booking_no as booking_no','room_booking.start_date as start_date','room_booking.end_date as end_date','cu.name as customer_name','cu.customer_no as customer_number','ro.room_number as room_number')->get();
      $datatable = Datatables::of($db_record);
      $datatable = $datatable->addIndexColumn();
       
    
      $datatable = $datatable->editColumn('booking_no', function($row)
      {
          return $row->booking_no;
          
      });
      $datatable = $datatable->editColumn('start_date', function($row)
      {
          return $row->start_date;
          
      });
      $datatable = $datatable->editColumn('end_date', function($row)
      {
          return $row->end_date;
          
      });
      $datatable = $datatable->editColumn('customer_name', function($row)
      {
          return $row->customer_name;
      });
      $datatable = $datatable->editColumn('customer_number', function($row)
      {
          return $row->customer_number;
      });
      $datatable = $datatable->editColumn('room_number', function($row)
      {
          return $row->room_number;
      });
      $datatable = $datatable->addColumn('action', function($row) use($hashids)
      {
          $actions = '<span class="actions">';
             
          
              $actions .= '&nbsp;<a class="btn btn-primary" href="'.url("admin/room-booking/" .$hashids->encode($row->id).'/edit').'" title="Edit"><i class="far fa-edit"></i></a>';
              $actions .= '&nbsp;<a class="btn btn-success" href="'.route("admin.print.invoice",['id'=>$hashids->encode($row->id)]).'" title="invoice">Invoice</a>';
          
              
          
                  $actions .= '<form method="POST" action="'.url("admin/room-booking/" . $hashids->encode($row->id)).'" accept-charset="UTF-8" style="display:inline;">';
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
      return view('admin.roombooking.listing',$data);
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
      $data['rooms'] = $this->fetchRooms();
      $data['customers'] = $this->fetchCustomers();
      $data['action'] = 'add';
      return View('admin.roombooking.form',$data);
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
      $input['room_id'] = $request->room_id;
      $input['customer_id'] = $request->customer_id;
      $input['start_date'] = $request->start_date;
      $input['end_date'] = $request->end_date;
      $model = new $this->model;
      $model->fill($input);
      if($model->save()){
          $lastCreatedRoom = $this->model::latest()->first();
          $lastCreatedRoom->booking_no = RoomBooking::$bookingNumberPrefix.$lastCreatedRoom->id;
          $lastCreatedRoom->save();
      }
      
      return redirect('admin/room-booking')->with('message','Data saved Successfully');
      }
      else
      {
          // if(!have_right('Access-Our-Departments') || 0)
          //     access_denied();

          $hashids = new Hashids('',10);
          $id = $input['id'];
          $id = $hashids->decode($id)[0];
          $model = $this->model::find($id);
          $input['room_id'] = $request->room_id;
          $input['customer_id'] = $request->customer_id;
          $input['start_date'] = $request->start_date;
          $input['end_date'] = $request->end_date;
          $model = new $this->model;
          $model->fill($input);
          $model->update();
          return redirect('admin/room-booking')->with('message','Data update Successfully');
         
         
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
      $row = $this->model::find($id);
      $data['row'] = $row;
      $data['rooms'] = $this->fetchRooms();
      $data['customers'] = $this->fetchCustomers();
      $data['action'] = 'edit';
      return View('admin.roombooking.form',$data);
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
      // access_denied(); `

      $data = [];
      $hashids = new Hashids('',10);
      $id = $hashids->decode($id)[0];
      $data['row'] = $this->model::destroy($id);
      return redirect('admin/room-booking')->with('message','Data deleted Successfully');
  }
  public function printInvoice($id)
  {
    $hashids = new Hashids('',10);
    $id = $hashids->decode($id)[0];
    $invoice = $this->model->where('room_booking.id',$id)->join('rooms as ro','room_booking.room_id','ro.id')
      ->join('customers as cu','room_booking.customer_id','cu.id')
      ->select('room_booking.*','ro.*','cu.*','room_booking.id as id','room_booking.booking_no as booking_no','room_booking.start_date as start_date','room_booking.end_date as end_date','cu.name as customer_name','cu.customer_no as customer_number','ro.room_number as room_number')->get()->first();
    $data['invoice'] = $invoice;
    return View('admin.roombooking.booking-invoice',$data); 
  }
}