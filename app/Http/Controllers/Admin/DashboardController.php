<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use App\Models\Admin\RoomBooking;
use App\Models\Admin\Customer;
use App\Models\Admin\Product;
use App\Models\Admin\Offer;
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
            'users'=>User::count(),
            'categories'=>Category::whereStatus(1)->count(),
            'products'=>Product::whereStatus(1)->count(),
            'offers'=>Offer::whereStatus(1)->count()
        ];
        return view('admin.dashboard')->with($data);
    }
}
