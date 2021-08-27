<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Cart;
use App\Models\category_post;
use App\Models\category_product;
use App\Models\Coupon;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
class CartController extends Controller
{

    // public function addCartAjax(Request $request){
    //     $data = $request->all();
    //     $cart = Cart::where('user_id', auth()->user()->id)->where('order_id',null)->where('product_id', $data['cart_product_id'])->first();
    //     if ($cart==true) {
    //         $is_avaiable = 0;
    //         $cart->product_qty = $cart->product_qty + 1;
    //         $cart->product_amount = $data['cart_product_price']+ $cart->product_amount;
    //         $cart->save();
    //     }else{
    //         $cart = new Cart;
    //         $cart->user_id = auth()->user()->id;
    //         $cart->product_id = $data['cart_product_id'];
    //         $cart->product_price = $data['cart_product_price'];
    //         $cart->product_qty = $data['cart_product_qty'];
    //         $cart->product_amount=($data['cart_product_price'] * $data['cart_product_qty']);
    //         $cart->save();
    //     }
    // }
    public function addCartAjax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_avaiable = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                    $cart[$key] = array(
                        'session_id' => $val['session_id'],
                        'product_name' => $val['product_name'],
                        'product_id' => $val['product_id'],
                        'product_image' => $val['product_image'],
                        'product_qty' => $val['product_qty']+ $data['cart_product_qty'],
                        'product_price' => $val['product_price'],
                        );
                        Session::put('cart',$cart);
                }
            }
            if($is_avaiable == 0){
                $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
            Session::put('cart',$cart);
        }
        Session::save();
        return redirect()->route('viewcart');
        // Session::forget('cart');
    }
    public function delCart($session_id){
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach($cart as $key=>$val){
                if ($val['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return redirect()->back()->with('mess', 'Xóa sản phẩm thành công');
        }else{
            return redirect()->back()->with('mess', 'Xóa sản phẩm thất bại');
        }
    }
    public function upCart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if ($cart==true) {
            foreach($data['cart_qty'] as $key=>$qty){
                foreach($cart as $session =>$val){
                    if($val['session_id'] == $key){
                        $cart[$session]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('mess', 'Cập nhật thành công');
        }else{
            return redirect()->back()->with('mess', 'Cập nhật thất bại');
        }
    }
    public function viewCart(){
        $allcategory = category_product::where('category_status', '1')->get();
        $category_post = category_post::where('category_post_status', '1')->get();
        return view('frontend.pages.show-cart', compact('allcategory', 'category_post'));
    }
    public function checkCoupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status', 1)->first();
        if ($coupon) {
            $count_coupon = $coupon->count();
            if ($count_coupon>0) {
               $coupon_session = Session::get('coupon');
                if ($coupon_session == true) {
                   $is_avaiable = 0;
                   if ($is_avaiable == 0) {
                       $cou[] = array(
                           'coupon_code' => $coupon->coupon_code,
                           'coupon_value' => $coupon->coupon_value,
                           'coupon_type' => $coupon->coupon_type,
                       );
                       Session::put('coupon', $cou);
                   }
                }else{
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_value' => $coupon->coupon_value,
                        'coupon_type' => $coupon->coupon_type,
                    );
                    Session::put('coupon', $cou);
                }
                Session::save();
                return redirect()->back()->with('mess', 'Thêm mã giảm giá thành công');
            }

        }else{
            return redirect()->back()->with('mess', 'Mã giảm giá không đúng');
        }

    }



}


