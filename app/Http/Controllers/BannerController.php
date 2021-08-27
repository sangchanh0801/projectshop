<?php

namespace App\Http\Controllers;

use App\Http\Requests\savebanner;
use App\Models\banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    //add_brand_product
    public function addBanner(){
        return view('admin.banner.add_banner');
    }
    public function saveBanner(savebanner $request){
        $data = new banner();
        $data->banner_name = $request->banner_name;
        $data->banner_slug = $request->banner_slug;
        $data->banner_desc = $request->banner_desc;
        $data->banner_status = $request->banner_status;
        $data->banner_image = $request->banner_image;
        $data->save();
        return redirect()->route('allbanner')->with('mess', 'Thêm banner thành công');
    }

//all_banner
    public function allBanner(){
        $allbanner= banner::paginate(4);
        return view('admin.banner.all_banner', compact('allbanner'));
    }
//edit_brand_product
    public function editBanner(Request $request ,$banner_id){
        $edit_banner = banner::findOrFail($banner_id);
        return view('admin.banner.edit_banner', compact('edit_banner'));

    }
    public function updateBanner(Request $request ,$banner_id){
        $edit_banner= banner::findOrFail($banner_id);
        $edit_banner->banner_name = $request->banner_name;
        $edit_banner->banner_slug = $request->banner_slug;
        $edit_banner->banner_desc = $request->banner_desc;
        $edit_banner->banner_image = $request->banner_image;
        $edit_banner->save();
        return redirect()->route('allbanner')->with('mess', 'Cập nhật banner thành công');
    }

//delete_brand_product
    public function deleteBanner($banner_id){
        $delete_brand = banner::findOrFail($banner_id);
        $delete_brand->delete();
        return redirect()->route('allbanner')->with('mess', 'Bạn đã xóa banner thành công');
    }

//active and unactive
    public function activeBanner($banner_id){
        $active = DB::table('banners')->where('banner_id', $banner_id)->update(['banner_status'=>0]);
        return redirect()->route('allbanner')->with('mess', 'Không kích hoạt banner');
    }
    public function unactiveBanner($banner_id){
        $unactive = DB::table('banners')->where('banner_id', $banner_id)->update(['banner_status'=>1]);
        return redirect()->route('allbanner')->with('mess', 'Kích hoạt banner');
    }
}
