<?php

namespace App\Http\Controllers;
use App\Models\category_post;
use App\Models\category_product;
use App\Models\City;
use App\Models\Coupon;
use App\Models\Feeship;
use App\Models\order;
use App\Models\order_detail;
use App\Models\payment;
use App\Models\Province;
use App\Models\shipping;
use App\Models\User;
use App\Models\Wards;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{

//CheckOut
    public function showCheckout(){
        $allcategory = category_product::where('category_status', '1')->get();
        $category_post = category_post::where('category_post_status', '1')->get();
        $city = City::orderBy('matp', 'ASC')->get();
        return view('frontend.pages.checkout', compact('allcategory', 'category_post', 'city'));
    }
    public function selectDeliveryHome(Request $request){
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action']=="city") {
                $select_province = Province::where('matp', $data['ma_id'])->get();
                $output.='<option>--Chọn quận huyện--</option>';
                foreach ($select_province as $key => $province){
                    $output .= '<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
                }
            }else{
                $select_wards = Wards::where('maqh', $data['ma_id'])->get();
                $output.='<option>--Chọn xã phường--</option>';
                foreach ($select_wards as $key => $ward){
                    $output .= '<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
                }
            }
        }
        echo $output;
    }
    public function calculateDelivery(Request $request){
        $data = $request->all();
        if ($data['matp']) {
           $feeship = Feeship::where('fee_matp', $data['matp'])
                            ->where('fee_maqh', $data['maqh'])
                            ->where('fee_xaid', $data['xaid'])->get();
            if ($feeship) {
                $count_feeship = $feeship->count();
                if ($count_feeship>0) {
                    foreach($feeship as $key=> $fee){
                        Session::put('fee', $fee->fee_ship);
                        Session::save();
                    }
                }else{
                    Session::put('fee', 10000);
                    Session::save();
                }

            }
        }
    }

    public function confirmOrder(Request $request){
        $data = $request->all();
        // if ($data['order_coupon'] != 'no') {
        //     $coupon = Coupon::where('coupon_code', $data['order_coupon'])->first();
        //     $coupon_mail = $coupon->coupon_code;
        // }else{
        //     $coupon_mail = 'Khong co';
        // }
        $shipping = new shipping();
        $shipping->shipping_fname = $data['shipping_fname'];
        $shipping->shipping_lname = $data['shipping_lname'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_city = $data['city'];
        $shipping->shipping_province = $data['province'];
        $shipping->shipping_wards = $data['wards'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();
        $shipping_id =  DB::getPdo()->lastInsertId();

        $checkout_code = substr(md5(microtime()),rand(0,26),5);
        $order = new order();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $order->customer_id = auth()->user()->id;
        $order->shipping_id = $shipping_id;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        $order->order_date = $today;
        $order->save();

        if (Session::get('cart')==true) {
           foreach(Session::get('cart') as $cart){
                $order_detail = new order_detail();
                $order_detail->order_code = $checkout_code;
                $order_detail->product_id = $cart['product_id'];
                $order_detail->product_name = $cart['product_name'];
                $order_detail->product_price = $cart['product_price'];
                $order_detail->product_sales_quantity = $cart['product_qty'];
                $order_detail->product_coupon =$data['order_coupon'];
                $order_detail->product_feeship =$data['order_fee'];
                $order_detail->save();
           }
        }
// //send_mail
//         $now = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m- H:i:s');
//         $title_mail = "Đơn hàng xác nhận ngày".' '.$now;
//         $customer = User::find(Session::get('user_id'));
//         $data['email'][] = $customer->email;
//         if (Session::get('cart') == true) {
//             foreach(Session::get('cart') as $key => $cart_mail){
//                 $cart_array[] = array(
//                     'product_name' => $cart_mail['product_name'],
//                     'product_price' => $cart_mail['product_price'],
//                     'product_qty' => $cart_mail['product_qty'],

//                 );
//             }
//         }
//         if(Session::get('fee')==true){
//             $fee = Session::get('fee').'k';
//           }else{
//             $fee = '25k';
//           }
//         $shipping_array = array(
//         'fee' => $fee,
//         'customer_name' => $customer->name,
//         'shipping_fname' => $data['shipping_fname'],
//         'shipping_lname' => $data['shipping_lname'],
//         'shipping_email' => $data['shipping_email'],
//         'shipping_phone' => $data['shipping_phone'],
//         'shipping_address' => $data['shipping_address'],
//         'shipping_notes' => $data['shipping_notes'],
//         'shipping_method' => $data['shipping_method'],
//         );
//         $ordercode_mail = array(
//             'coupon_code' =>$coupon_mail,
//             'order_code' =>$checkout_code,
//         );
//     Mail::send('frontend.pages.mail_order', ['cart_array'=>$cart_array, 'shipping_array'=> $shipping_array,  'code' => $ordercode_mail],
//     function($message) use ($title_mail, $data){
//         $message->to($data['email'])->subject($title_mail);
//         $message->from($data['email'],$title_mail);

//     });

        Session::forget('cart');
        Session::forget('fee');
        Session::forget('coupon');
    }




}
