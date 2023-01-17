<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactForm\ContactRecord;
use Illuminate\Http\Request;
use DataTables;

class ContactController extends Controller
{


    //______________update contact status_______//
    public function updateStatus(Request $request)
    {
        // dd($request->all());
        $data = ContactRecord::where('id', $request->id)->first()->update(['status' =>  $request->status]);
        if ($data) {
            echo 1;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->ipinfo->all);
        if (!have_right('Access-Contacts'))
            access_denied();
        $data = [];
        if ($request->ajax()) {
            $db_record = ContactRecord::orderBy('created_at', 'DESC')->get();
            $datatable = Datatables::of($db_record);
            $datatable = $datatable->addIndexColumn();
            $datatable = $datatable->addColumn('UpdateStatus', function ($row) {
                $statusPending = '';
                $statusInprogress = '';
                $statusApproved = '';
                if ($row->status == 0) {
                    $statusPending = 'selected';
                } elseif ($row->status == 1) {
                    $statusInprogress = 'selected';
                } elseif ($row->status == 2) {
                    $statusApproved = 'selected';
                }
                return  '<select class="" name="status" onChange="changeStatuscontact(' . $row->id . ',$(this).val())"  ><option>--select status--</option><option value="0" ' . $statusPending . ' >Pending</option><option value="1" ' . $statusInprogress . ' >In Progress</option><option value="2" ' . $statusApproved . '>Approve</option></select>';
            });
            $datatable = $datatable->addColumn('action', function ($row) {
                $actions = '<span class="actions">';

                if (have_right('Access-Contacts')) {
                    $actions .= '<a class="btn btn-primary d-none" href="' . url("admin/contacts/" . $row->id . '/edit') . '" title="Edit"><i class="far fa-edit"></i></a>';
                }

                if (have_right('Access-Contacts')) {
                    $actions .= '<form method="POST" action="' . url("admin/contacts/" . $row->id) . '" accept-charset="UTF-8" style="display:inline;">';
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

            $datatable = $datatable->rawColumns(['action', 'UpdateStatus', 'message']);
            $datatable = $datatable->make(true);
            return $datatable;
        }
        return view('admin.contacts.listing', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!have_right('Access-Contacts'))
            access_denied();

        $data = [];
        $data['row'] = ContactRecord::destroy($id);
        return redirect('admin/contacts')->with('message', 'Data deleted Successfully');
    }
}
