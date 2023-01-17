<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription\NewSubscription;
use Illuminate\Http\Request;
use DataTables;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->ipinfo->all);
        if (!have_right('Access-Subscription'))
            access_denied();
        $data = [];
        if ($request->ajax()) {
            $db_record = NewSubscription::orderBy('created_at', 'DESC')->get();
            $datatable = Datatables::of($db_record);
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

                if (have_right('Access-Subscription')) {
                    $actions .= '<a class="btn btn-primary d-none" href="' . url("admin/ceomessage/" . $row->id . '/edit') . '" title="Edit"><i class="far fa-edit"></i></a>';
                }

                if (have_right('Access-Subscription')) {
                    $actions .= '<form method="POST" action="' . url("admin/subscriptions/" . $row->id) . '" accept-charset="UTF-8" style="display:inline;">';
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
        return view('admin.subscription.listing', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!have_right('Access-Subscription'))
            access_denied();

        $data = [];
        $data['row'] = NewSubscription::destroy($id);
        return redirect('admin/subscriptions')->with('message', 'Data deleted Successfully');
    }
}
