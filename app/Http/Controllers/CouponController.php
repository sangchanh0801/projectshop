<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveCoupon;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function addCoupon(){
        return view('admin.coupon.add_coupon');
    }
    public function saveCoupon(saveCoupon $request){
        $data= $request->all();
        $coupon = new Coupon();
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_type = $data['coupon_type'];
        $coupon->coupon_value = $data['coupon_value'];
        $coupon->coupon_status = $data['coupon_status'];
        $coupon->save();
        return redirect()->route('allcoupon')->with('mess', 'Thêm mã giảm giá thành công');
    }
    public function allCoupon(){
        $allcoupon = Coupon::paginate(4);
        return view('admin.coupon.all_coupon', compact('allcoupon'));
    }
    public function deleteCoupon($coupon_id){
        $deletecoupon = Coupon::findOrfail($coupon_id);
        $deletecoupon->delete();
        return redirect()->route('allcoupon')->with('mess', 'Bạn đã xóa mã giảm giá thành công');
    }
    public function editCoupon($coupon_id){
        $edit_coupon = Coupon::findOrFail($coupon_id);
        return view('admin.coupon.edit_coupon', compact('edit_coupon'));
    }

    public function updateCoupon(Request $request ,$coupon_id){
        $editcoupon = Coupon::findOrfail($coupon_id);
        $data = $request->all();
        $editcoupon->coupon_code = $data['coupon_code'];
        $editcoupon->coupon_type = $data['coupon_type'];
        $editcoupon->coupon_value = $data['coupon_value'];
        $editcoupon->coupon_status = $data['coupon_status'];
        $editcoupon->save();
        return redirect()->route('allcoupon')->with('mess', 'Bạn đã cập nhật mã giảm giá thành công');
    }


    public function activeCoupon($coupon_id){
        $active = DB::table('coupons')->where('coupon_id', $coupon_id)->update(['coupon_status'=>0]);
        return redirect()->route('allcoupon')->with('mess', 'Không kích hoạt mẫ giảm giá');
    }
    public function unactiveCoupon($coupon_id){
        $unactive = DB::table('coupons')->where('coupon_id', $coupon_id)->update(['coupon_status'=>1]);
        return redirect()->route('allcoupon')->with('mess', 'Kích hoạt mã giảm giá');
    }


}
