<?php

namespace App\Http\Controllers;
use App;
use App\Models\Admin\{Product,Offer};
use Illuminate\Http\Request;
use Response;
// use Gloudemans\Shoppingcart\Facades\Cart;
class CartController extends Controller
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
    public function cartList()
    {
         $cartItems = \Cart::getContent();
        return view('store.pages.cart',['cart_items'=>$cartItems]);
    }
   
    public function AddToCart(Request $request){
        // dd($request->all());
        if($request->cart_type==getCartTypeProduct())
        {
            $product = Product::where('id',$request->product_id)->with('productImages')->first();
            $id = getCartTypeProduct().'-'.$request->product_id;
            \Cart::add([
                'id'=>$id,
                'name'=>$product->title,
                'price'=>$request->product_price,
                'quantity'=>$request->product_qty,
                'attributes' => array(
                    'type'=>getCartTypeProduct()
                ),
                'associatedModel'=>$product
            ]);
        } elseif($request->cart_type==getCartTypeOffer())
        {
            $offer = Offer::where('id',$request->product_id)->with('offerImages')->first();
            $id = getCartTypeOffer().'-'.$request->product_id;
            \Cart::add([
                'id'=>$id,
                'name'=>$offer->title,
                'price'=>$request->product_price,
                'quantity'=>$request->product_qty,
                'attributes' => array(
                    'type'=>getCartTypeOffer()
                ),
                'associatedModel'=>$offer
            ]);
        }
        
        // $cartItems = \Cart::getContent();
        $this->response['message'] = 'successfully Add into Cart';
        $this->response['data'] = ['total_cart_product'=>\Cart::getTotalQuantity()];
        return response()->json($this->response);
    }
    function RemoveToCart(Request $request){
    \Cart::remove($request->item_id);
    $this->response['message'] = 'successfully Add into Cart';
    $this->response['data'] = ['total_cart_product'=>\Cart::getTotalQuantity()];
    return response()->json($this->response);
    }
    function updateCartQty(Request $request){
        $itemId = $request->item_id;
        \Cart::update(
            $itemId,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->qty
                ],
            ]
        );
        $this->response['message'] = 'successfully Add into Cart';
        $this->response['data'] = [
        'total_cart_product'=>\Cart::getTotalQuantity(),
        'item_sub_total'=>\Cart::get($itemId)->getPriceSum(),
        'sub_total'=>\Cart::getSubTotal(),
        'total'=>\Cart::getTotal()
        ]; 
        return response()->json($this->response);
    }
  
}
