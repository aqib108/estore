<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Donation;
use App\Models\Admin\Language;
use App\Models\Admin\DonationReceipt;
use App\Models\Admin\EmployeeSection;
use App\Models\Admin\Notification;
use App\Models\Admin\Section;
use App\Models\Subscription\NewSubscription;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Session;
use Illuminate\Http\Request;
use DataTables;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!have_right('Access-Doantions'))
            access_denied();

        $data = [];
        if ($request->ajax()) {
            $db_record = Donation::orderBy('created_at', 'DESC')->get();
            $datatable = Datatables::of($db_record);
            $datatable = $datatable->addIndexColumn();
            $datatable = $datatable->editColumn('title', function($row)
            {
                $title = (array)json_decode($row->title);
                return $title['en'];

            });
            $datatable = $datatable->editColumn('status', function ($row) {
                $status = '<span class="badge badge-danger">Disable</span>';
                if ($row->status == 1) {
                    $status = '<span class="badge badge-success">Active</span>';
                }
                return $status;
            });
            $datatable = $datatable->addColumn('featured', function ($row) {
                if ($row->is_featured == 1) {
                    $checked = 'checked';
                } else {
                    $checked = '';
                }
                if (have_right('Access-Doantions')) {
                    $featured = '<label class="switch"> <input type="checkbox" class="is_featured" id="chk_' . $row->id . '" name="is_featured" onclick="is_featured($(this),' . $row->id . ')" ' . $checked . ' > <span class="slider round"></span></label>';
                    return $featured;
                } else {
                    return '<span class=" badge badge-danger">No Permission</span>';
                }
            });
            $datatable = $datatable->addColumn('action', function ($row) {
                $actions = '<span class="actions white-space">';

                // if (have_right('View-Reciepts-Doantions')) {
                //     $actions .= '<a class="btn btn-primary" href="' . url("admin/donations/reciepts/" . $row->id) . '" title="Reciepts"><i class="far fa-eye"></i></a>';
                // }

                if (have_right('Access-Doantions')) {
                    $actions .= '<a class="btn btn-primary" style="margin-left:02px;" href="' . url("admin/donations/" . $row->id . '/edit') . '" title="Edit"><i class="far fa-edit"></i></a>';
                }
                if (have_right('Access-Doantions')) {
                    $actions .= '&nbsp;<a data-toggle="modal" data-target="#showNoteModal" class="btn btn-secondary show_note" href="javascript:void(0)" data-donation-id="' . $row->id . '" title="Show"><i class="fa fa-sticky-note"></i></a>';
                }

                // if (have_right('Delete-Doantions')) {
                //     $actions .= '<form method="POST" action="' . url("admin/donations/" . $row->id) . '" accept-charset="UTF-8" style="display:inline;">';
                //     $actions .= '<input type="hidden" name="_method" value="DELETE">';
                //     $actions .= '<input name="_token" type="hidden" value="' . csrf_token() . '">';
                //     $actions .= '<button class="btn btn-danger" style="margin-left:02px;" onclick="return confirm(\'Are you sure you want to delete this record?\');" title="Delete">';
                //     $actions .= '<i class="far fa-trash-alt"></i>';
                //     $actions .= '</button>';
                //     $actions .= '</form>';
                // }

                $actions .= '</span>';
                return $actions;
            });

            $datatable = $datatable->rawColumns(['status', 'action', 'featured']);
            $datatable = $datatable->make(true);
            return $datatable;
        }
        return view('admin.donation.listing', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!have_right('Access-Doantions'))
            access_denied();
        $data = [];
        $data['row'] = new Donation;
        $data['action'] = 'add';
        $data['languages'] = Language::all();
        return View('admin.donation.form', $data);
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
        // dd($input);
        $validator = Validator::make($request->all(), [
            'price' => 'required',
            'donation_type' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_danger', $validator->messages());
            return redirect()->back()->withInput();
        }

        if ($input['action'] == 'add') {
            if (!have_right('Access-Doantions'))
                access_denied();
            $model = new Donation();
            if (isset($input['file'])) {
                $imagePath = $this->uploadimage($request);
                $model->file=$imagePath;
            }
            
            $model->title=json_encode($request->title);
            $model->description=json_encode($request->description);
            $model->price=$request->price;
            $model->donation_type=$request->donation_type;
            $model->status=$request->status;
            $model->save();
            return redirect('admin/donations')->with('message', 'Data added Successfully');
        } else {
            if (!have_right('Access-Doantions'))
                access_denied();

            $id = $input['id'];
            $model = Donation::find($id);

            // @for delete images
            if (isset($input['file'])) {
                $imagePath = $this->uploadimage($request);
                $model->file=$imagePath;
                $image_url =  $model->file;
                if (file_exists(public_path($image_url))) {
                    unlink($image_url);
                }
            } else {
                unset($input['image']);
            }
            // @for delete images
            $model->title=json_encode($request->title);
            $model->description=json_encode($request->description);
            $model->price=$request->price;
            $model->donation_type=$request->donation_type;
            $model->status=$request->status;
            $model->update();
            return redirect('admin/donations')->with('message', 'Data updated Successfully');
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!have_right('Access-Doantions'))
            access_denied();

        $data = [];
        $data['id'] = $id;
        // $id = Hashids::decode($id)[0];
        $data['row'] = Donation::find($id);
        $data['action'] = 'edit';
        $data['languages'] = Language::all();
        return View('admin.donation.form', $data);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!have_right('Access-Doantions'))
            access_denied();

        $model = Donation::find($id);
        $image_url =  $model->file;
        // dd(public_path($image_url));
        if (!empty($image_url)) {
            if (file_exists(public_path($image_url))) {
                unlink($image_url);
            }
        }
        $data = [];
        $data['row'] = Donation::destroy($id);
        return redirect('admin/donations')->with('message', 'Data deleted Successfully');
    }
    /**
     * upload the image .
     *
     */
    public function uploadimage(Request $request)
    {
        $path = '';
        if ($request->file) {
            $imageName = 'donation' . time() . '.' . $request->file->extension();
            if ($request->file->move(public_path('images/donation/'), $imageName)) {
                $path =  'images/donation/' . $imageName;
            }
        }
        return $path;
    }
    public function setFeaturedDonation($id = null)
    {
        Donation::where('is_featured', 1)->update(['is_featured' => 0]);
        $update_donations = Donation::where('id', $id)->update(['is_featured' => $_GET['status']]);
        if ($update_donations) {
            echo true;
            exit();
        }
    }
    public function showTransferPayment(Request $request)
    {
        $donationRecieptId = $request->donationRecieptId;
        $data['donationRecieptData'] = DonationReceipt::with('donationRecieptDetails.paymentMethod', 'donationRecieptDetails.paymentMethodDetail', 'donationPaymentMethod.donationPaymentMethodDetails', 'donationPaymentMethod.paymentMethod')
            ->where('donation_receipts.id', $donationRecieptId)
            ->first();
        // dd($data['donationRecieptData']);
        $html = (string)View('admin.partial.donation-reciept-details-partial', $data);
        echo $html;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function recievedAmount(Request $request)
    {
        if ($request->isMethod('get')) {
            $donation = Donation::find($request->id);
            $html = view('admin.partial.show-received-amount', get_defined_vars())->render();

            return response()->json(['html' => $html, 'status' => 200]);
        }
        if ($request->isMethod('post')) {
            // dd($request->received_amount);
            $donation = Donation::find($request->donation_id);
            $donation->received_amount=$request->received_amount;
            if ($donation->save()) {
                $response['status'] = 'success';
                $response['message'] = 'Amount submitted successfully!!';
            }
            echo json_encode($response);
            exit();
        }
    }
}
