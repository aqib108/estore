<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\{Product, Offer, IssueBooking, Order};
use App\Models\ContactForm\ContactRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance work.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::whereStatus(1)->get();
        $data['categories'] = $categories;
        $data['offers']  = Offer::whereStatus(1)->with('offerImages')->get()->take(3);
        return view('store.pages.home', $data);
    }
    public function ServicesPage(){
        return view('store.pages.service');   
    }

    function getProductsDetailPage(Request $request, $sku)
    {
        $product = Product::whereSku($sku)->with('productImages')->first();
        return view('store.pages.products.product_detail', ['product' => $product]);
    }
    function getOfferDetailPage(Request $request, $sku)
    {
        $offer = Offer::whereSku($sku)->with('offerImages')->first();
        return view('store.pages.offer.offer_detail', ['offer' => $offer]);
    }

    function offerLists()
    {
        $offers = Offer::whereStatus(1)->with('offerImages')->get();
        return view('store.pages.offers', ['offers' => $offers]);
    }

    function SaveContactus(Request $request)
    {
        $contact = new ContactRecord();
        $contact->email = $request->email;
        $contact->description = $request->description;
        $contact->sbooave();
        return back()->with('msg', 'successfully Send Your Response');
    }
    function SaveIssueBooking(Request $request)
    {
        $booking = new IssueBooking();
        $booking->name = $request->name;
        $booking->phone = $request->phone;
        $booking->description = $request->description;
        $booking->location = $request->location;
        $booking->save();
        return back()->with('msg', 'Your Booking Information Successfully Send');
    }
    function Contactus(Request $request)
    {
        return view('store.pages.contact_us');
    }
    function Aboutus(Request $request)
    {
        return view('store.pages.about');
    }
    function IssueBookingPage(Request $request)
    {
        return view('store.pages.issue_booking');
    }

    public function getProducts(Request $request)
    {
        $response['status'] = true;
        $category = $request->get('category');
        if ($category == 'all') {
            $products = Product::whereStatus(1)->with('productImages')->get();
        } else {
            $products = Product::whereStatus(1)->whereCategoryId($category)->with('productImages')->get();
        }
        if ($request->ajax()) {
            $response['html'] = view('store.pages.products.product-cart', ['products' => $products])->render();
            return response()->json($response);
        } else {
            $categoryName = 'All';
            if ($category != 'all') {
                $categoryName = Category::whereId($category)->first()->name;
            }
            return view('store.pages.catlog', ['products' => $products, 'category_name' => $categoryName]);
        }
    }
    function checkoutPage(Request $request)
    {
        $cartItems = \Cart::getContent();
        if(!empty($cartItems) && count($cartItems)){
            return view('store.pages.order', ['cart_items' => $cartItems]);
        }
        else{
            return redirect()->back();
        }

    }
    function saveOrder(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'billing_user_name' => ['required', 'string', 'max:255'],
            'billing_email' => ['required', 'string', 'email', 'max:255'],
            'billing_phone_number' => ['required'],
            'billing_city' => ['required'],
            'billing_address' => ['required'],
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $userID = (Auth::check()) ? Auth::user()->id : null;

        $orderModal = new Order();

        $orderModal->fill($request->all());
        $orderModal->fill(['user_id' => $userID]);
        $orderModal->fill(['sub_total' => \Cart::getSubTotal()]);
        $orderModal->fill(['grand_total' => \Cart::getTotal()]);

        if ($orderModal->save()) {
            // dd("ok");
            $items = [];
            $cartItems = \Cart::getContent();
            foreach ($cartItems as $key => $item) {
                // dd("ok");
                $items[$key]['order_id'] = $orderModal->id;
                $items[$key]['user_id'] = $userID;
                $items[$key]['product_id'] = preg_replace('/\D/', '', $item->id);
                $items[$key]['quantity'] = $item->quantity;
                $items[$key]['unit_price'] = $item->price;
                $items[$key]['total'] = ($item->quantity * $item->price);
                $items[$key]['order_type'] = $item->attributes->type == getCartTypeOffer() ? 2 : 1;
            }

            $orderModal->orderItems()->createMany($items);

            $response = [];
            $response['status'] = 1;
            $response['message'] = 'Order Placed.';

            \Cart::clear();

            return view('store.pages.order-sucess-page');
        }
    }
}
