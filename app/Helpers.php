<?php

use App\Models\Admin\Category;
use App\Models\Admin\Setting;
use App\Models\Admin\Product;
use App\Models\Admin\Offer;
use Illuminate\Support\Facades\Crypt;
function rights()
{
    $result = DB::table('rights')
            ->select('rights.name as right_name', 'modules.name as module_name')
            ->join('modules', 'rights.module_id', '=', 'modules.id')
            ->where(['rights.status' => 1])
            ->get()
            ->toArray();

    $array = [];

    for ($i = 0; $i < count($result); $i++)
    {
        $array[$result[$i]->module_name][] = $result[$i];
    }
    return $array;
}

function have_right($right_id)
{
    $user = \Auth::user();
    // dd($user);
    if ($user['role_id'] == 1)
    {
        return true;
    }
    else
    {
        $result = \DB::table('roles')
                ->where('id', $user['role_id'])
                ->whereRaw("find_in_set('".$right_id."',right_ids)")
                ->first();

        if (!empty($result))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

function access_denied()
{
    abort(403, 'You have no right to perform this action.');
}
//get app languages
function getLanguages(){
   return DB::table('languages')->wherestatus(1)->get();
}
//set language
function set_locale($content=''){
    $content = (array)json_decode($content);
    return (isset($content[App::getLocale()])) ? $content[App::getLocale()] : $content['en'];    
}

function getSettingDataHelper($key)
{
    $settingsArray = Session::get('settings');
    if (!empty($settingsArray[$key])) {
        return $settingsArray[$key];
    } else {
        return '#';
    }
}
function getSetting($key)
{
    $settings = Setting::where('option_name' , $key)->pluck('option_value')->first();
    if (!empty($settings)) {
        return $settings;
    } else {
        return '';
    }
}

function generateSku(){
    return 'PRO-'.time();
}
function generateOfferSku(){
    return 'OFFER-'.time();
}
function getCompanyEmail(){
    return getSetting('email');
}
function getCompanyPhoneNo(){
    return getSetting('phone');
}
function getCompanyLocationName(){
    return getSetting('location_1');
}
function getProductName(){
    return 'Crative Glass';
}
function getProductCategories(){
   return DB::table('categories')->where('status',1)->get();
}
function encryptData($value){
    return Crypt::encrypt($value);   
}
function decryptData($value){
    return Crypt::decrypt($value); 
}
function getCartTypeOffer(){
    return 'Offer';
}
function getCartTypeProduct(){
    return 'Product';
}
// Encryption
// Encryption function
function encryptOrderNumber($orderId) {
    return 'ORDER-AB00G0'.$orderId;
}

// Decryption function
// Decryption function (not secure, just for demonstration)
function decryptOrderNumber($encryptedOrderId) {
    // Remove the prefix 'Order-AB00G0'
    $orderId = str_replace('ORDER-AB00G0', '', $encryptedOrderId);

    return $orderId;
}
function findTheProductAmount($productPrice,$tax=0,$discount=0){
    $tax = $tax/100*$productPrice;
    $discount = $discount/100*$productPrice;
    return $productPrice+$tax-$discount;
}
function getProductByCol($id,$col,$orderType){
    if($orderType==1){
       return Product::where('id',$id)->get()->first()->toArray()[$col];
    } elseif($orderType==2){
      return Offer::whereId($id)->get()->first()->toArray()[$col];   
    }
    return null;

}
?>
