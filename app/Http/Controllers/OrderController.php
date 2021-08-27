<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Coupon;
use App\Models\order;
use App\Models\order_detail;
use App\Models\product;
use App\Models\Province;
use App\Models\shipping;
use App\Models\Statistic;
use App\Models\User;
use App\Models\Wards;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function manegeOrder(){
        $manege_order = order::paginate(3);
        return view('admin.maneger-order.all_maneger_order', compact('manege_order'));
    }

    public function viewOrder($order_code){
        $order = order::where('order_code', $order_code)->get();
        foreach($order as $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
        }
        $customer = User::where('id', $customer_id)->first();
        $shipping = shipping::where('shipping_id', $shipping_id)->first();
        $city = City::where('matp', $shipping->shipping_city)->first();
        $province = Province::where('maqh', $shipping->shipping_province)->first();
        $wards = Wards::where('xaid', $shipping->shipping_wards)->first();
        $order_details = order_detail::with('product')->where('order_code', $order_code)->get();
        foreach ($order_details as $order_d){
            $product_coupon = $order_d->product_coupon;
            $product_feeship = $order_d->product_feeship;
        }
        if ($product_coupon != '0') {
            $coupon = Coupon::where('coupon_code', $product_coupon)->first();
            $coupon_value = $coupon->coupon_value;
            $coupon_type = $coupon->coupon_type;
        }else{
            $coupon_value = 0;
            $coupon_type = 3;
        }

        return view('admin.maneger-order.view_order', compact('order_details', 'customer','shipping', 'city', 'province', 'wards', 'coupon_value', 'coupon_type', 'product_feeship', 'order'));
    }
    public function updateOrder(Request $request){
        $data = $request->all();
        $order = order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();
        //order_date
        $or = order::findOrFail($data['order_id']);
        $order_date = $or->order_date;
        $statistic = Statistic::where('order_date', $order_date)->get();
        if ($statistic) {
            $statistic_count = $statistic->count();
        }else{
            $statistic_count = 0;
        }

        if ($order->order_status == 2) {
            $total_order = 0;
            $sales = 0;
            $profit = 0;
            $quantity = 0;
            foreach($data['order_product_id'] as $key => $product_id){
                $product = product::find($product_id);
                $product_number = $product->product_number;
                $product_sold = $product->product_sold;
                $product_price = $product->product_price;
                $product_cost = $product->product_cost;
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                foreach($data['quantity'] as $key2=>$qty){
                    if ($key == $key2) {
                        $pro_remain = $product_number - $qty;
                        $product->product_number = $pro_remain;
                        $product->product_sold = $product_sold + $qty;
                        $product->save();
                        //update_doanhthu
                        $quantity += $qty;
                        $total_order += 1;
                        $sales += $product_price*$qty;
                        $profit += $sales - ($product_cost*$qty);
                    }
                }
            }
            if($statistic_count > 0){
                $statistic_update = Statistic::where('order_date', $order_date)->first();
                $statistic_update->sales = $statistic_update->sales + $sales;
                $statistic_update->profit = $statistic_update->profit + $profit;
                $statistic_update->quantity = $statistic_update->quantity + $quantity;
                $statistic_update->total_order = $statistic_update->total_order + $total_order;
                $statistic_update->save();
            }else{
                $statistic_new = new Statistic();
                $statistic_new->order_date = $order_date;
                $statistic_new->sales = $sales;
                $statistic_new->profit = $profit;
                $statistic_new->quantity = $quantity;
                $statistic_new->total_order = $total_order;
                $statistic_new->save();
            }
        }elseif ($order->order_status == 1) {
            foreach($data['order_product_id'] as $key => $product_id){
                $product = product::find($product_id);
                $product_number = $product->product_number;
                $product_sold = $product->product_sold;
                foreach($data['quantity'] as $key2=>$qty){
                    if ($key == $key2) {
                        $pro_remain = $product_number + $qty;
                        $product->product_number = $pro_remain;
                        $product->product_sold = $product_sold - $qty;
                        $product->save();
                    }
                }
            }
        }
    }

}
