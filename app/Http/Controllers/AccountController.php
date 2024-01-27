<?php

namespace App\Http\Controllers;
use App;
use App\Models\Admin\{Product,Offer,Order};
use App\Models\User;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\Auth;
// use Gloudemans\Shoppingcart\Facades\Cart;
class AccountController extends Controller
{
    /**
     * Create a new controller instance work.
     *
     * @return void
     */
    protected $response = ['status'=>200,'message'=>'','data'=>[]];
    public function __construct()
    {
       
    }
    public function getAccountPage()
    {
        return view('store.pages.account',[]);
    }
    public function getOrderListingPage()
    {
        $data['status'] = true;
        $userId = auth()->user()->id;
        $orders = Order::whereUserId($userId)->with('orderItems')->get();
        $data['html'] =  view('store.pages.order-listing',['cart_items'=>[],'orders'=>$orders])->render();
        return response()->json($data);
    }
    function getAccountSettingPage(){
        $data['status'] = true;
        $data['html'] =  view('store.pages.account-setting',[])->render();
        return response()->json($data);
    }
    function updateAccountSetting(Request $request) {
      $data['status'] = true;
      $user = new User();
      $userId = auth()->user()->id;
      $user = User::find($userId);
      $user->name = $request->name;
      $user->email = $request->email;
      $user->save();
      if($user->email!=auth()->user()->email){
        Auth::logout();
        $data['is_logout'] = true;
      }
      $data['message'] = 'Data successfylly Update';
      return response()->json($data);      

    }
  
}
