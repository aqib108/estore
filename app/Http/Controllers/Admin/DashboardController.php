<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\RoomBooking;
use App\Models\Admin\Customer;
use App\Models\Admin\Room;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
    public function index()
    {
        if(!have_right('Access-Dashboard'))
            access_denied();
        $data = [
            'users'=>0,
            'categories'=>0,
            'products'=>0,
            'orders'=>0
        ];
        return view('admin.dashboard')->with($data);
    }
}
