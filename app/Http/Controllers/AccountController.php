<?php

namespace App\Http\Controllers;
use App;
use App\Models\Admin\{Product,Offer};
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
   
    
  
}
