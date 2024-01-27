<?php

namespace App\Http\Controllers;
use App;
use App\Models\Admin\{Product,Offer,Order};
use Illuminate\Http\Request;
use Response;
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
    
  
}
