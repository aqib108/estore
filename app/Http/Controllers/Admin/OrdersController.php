<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Order;
use App\Models\Admin\OrderItem;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Hashids\Hashids;
use PDF;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!have_right('View-Orders')) {
            access_denied();
        }

        $data = [];
        if ($request->ajax()) {
            $order_status = (isset($_GET['order_status']) && $_GET['order_status']) ? $_GET['order_status'] : '';
            $from_date = (isset($_GET['from_date']) && $_GET['from_date']) ? $_GET['from_date'] : '';
            $to_date = (isset($_GET['to_date']) && $_GET['to_date']) ? $_GET['to_date'] : '';
            $db_record = Order::orderBy('created_at', 'DESC')->get();
            $db_record = $db_record->when($order_status, function ($q, $order_status) {
                return $q->where('status', $order_status);
            });
            $db_record = $db_record->when($from_date, function ($q, $from_date) {
                $startDate = date('Y-m-d', strtotime($from_date)) . ' 00:00:00';
                return $q->where('created_at', '>=', $startDate);
            });
            $db_record = $db_record->when($to_date, function ($q, $to_date) {
                $endDate = date('Y-m-d', strtotime($to_date)) . ' 23:59:00';
                // dd($endDate);
                return $q->where("created_at", '<=', $endDate);
                // return $q->whereRaw("(date(created_at) <='" . $endDate . "')");
            });

            $hashids = new Hashids('',10);
            $datatable = Datatables::of($db_record);
            $datatable = $datatable->addIndexColumn();
            $datatable = $datatable->editColumn('status', function ($row) {
                $status = '';

                if ($row->status == 1) {
                    $status = '<span class="badge badge-info">Pending</span>';
                } elseif ($row->status == 2) {
                    $status = '<span class="badge badge-warning">Shipped</span>';
                } elseif ($row->status == 3) {
                    $status = '<span class="badge badge-success">Completed</span>';
                } elseif ($row->status == 4) {
                    $status = '<span class="badge badge-secondary">Rejected</span>';
                } else {
                    $status = '<span class="badge badge-danger">Cancelled</span>';
                }

                return $status;
            });
            $datatable = $datatable->editColumn('user_id', function ($row) use($hashids) {
                if ($row->user_id) {
                    $userData = User::where('id', $row->user_id)->first();
                    $name='<a href="'. url("admin/customers/" .$hashids->encode($userData?->id).'/edit').'")">'.$userData?->name.'</a>';
                    return $name;
                } else {
                    return "Guest User";
                }
            });
            $datatable = $datatable->addColumn('action', function ($row)  {
                $actions = '<span class="actions">';
                if ($row->status != 4) {

                    if (have_right('Ready-Orders') || have_right('Complete-Orders')) {
                        if ($row->status == 1 && have_right('Ready-Orders')) {
                            $actions .= '<a class="btn btn-warning  ml-2" href="javascript:void(0)" title="Ready Shipment" onclick="orderStatusChange(' . $row->id . ',2)"><i class="fa fa-truck" style="color:white;"></i></a>';
                        } elseif ($row->status == 2 && have_right('Complete-Orders')) {
                            $actions .= '<a class="btn btn-success  ml-2" href="javascript:void(0)" title="Complete Shipment" onclick="orderStatusChange(' . $row->id . ',3)"><i class="fa fa-check"></i></a>';
                        }
                    }
                    if (have_right('View-Detail-Orders')) {
                        $actions .= '<a class="btn btn-primary ml-2" href="javascript:void(0)" title="Show" onclick="showOrderDetails(' . $row->id . ')"><i class="far fa-eye"></i></a>';
                    }
                    if (have_right('Reject-Orders')) {
                        $actions .= '<a class="btn btn-secondary ml-2" href="javascript:void(0)" title="Reject" onclick="orderStatusChange(' . $row->id . ',4)"><i class="fa fa-times" aria-hidden="true"></i></a>';
                    }
                    if (have_right('Download-Orders-Invoice')) {
                        $actions .= '<a class="btn btn-secondary ml-2" href="'.route("order-invoice",['order'=>$row->id,'back_url'=>'admin/orders']).'" target="_blank" title="Download Invoice"><i class="fa fa-download" aria-hidden="true"></i></a>';
                    }
                }

                if (have_right('Delete-Orders')) {
                    if ($row->status == 1) {
                        $actions .= '<a class="btn btn-danger ml-2" href="javascript:void(0)" title="Delete" onclick="orderStatusChange(' . $row->id . ',4)"><i class="far fa-trash-alt"></i></a>';
                    }
                }

                $actions .= '</span>';
                return $actions;
            });

            $datatable = $datatable->rawColumns(['status', 'action', 'user_id']);
            $datatable = $datatable->make(true);
            return $datatable;
        }
        return view('admin.orders.listing', $data);
    }

    public function orderDetails(Request $request)
    {
        $data = [];
        $order_id = $request->order_id;
        $data['OrderItemdata'] = OrderItem::where('order_id', $order_id)->get();
        $data['orderData'] = Order::where('orders.id', $order_id)->first();
        $html = (string) view('admin.partial.order-details', $data);
        $response = [];
        $response['html'] = $html;
        echo json_encode($response);
        exit();
    }

    //_____________Update Order Status____________//
    public function updateOrderStatus(Request $request)
    {
        // dd("ok");
        $id = $request->id;
        $status = $request->change_number;
        $update_status = Order::where('id', $id)->update(['status' => $status]);
        if ($update_status) {

            echo true;
            exit();
        }
    }

    public function orderInvoice($order_id){
        $data = [];
        $data['OrderItemdata'] = OrderItem::where('order_id', $order_id)->get();
        $data['orderData'] = Order::where('orders.id', $order_id)->first();
        return view('admin.orders.invoice',$data);
          
        // $pdf = PDF::loadView('admin.orders.invoice', $data);
        // $pdfName = '8order-invoice-'.encryptOrderNumber($order_id);
        // return $pdf->download($pdfName);
    } 
}
