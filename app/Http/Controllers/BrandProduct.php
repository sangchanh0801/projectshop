<?php

namespace App\Http\Controllers;
use App\Models\brand_product;
use Illuminate\Http\Request;
use App\Http\Requests\saveBrand;
use App\Http\Requests\updateBrand;
use App\Models\category_post;
use App\Models\category_product;
use App\Models\product;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
class BrandProduct extends Controller
{
//add_brand_product
    public function addBrandProduct(){
        return view('admin.brand.add_brand_product');
    }
    public function saveBrand(saveBrand $request){
        $data = new brand_product();
        $data->brand_name = $request->brand_name;
        $data->brand_desc = $request->brand_desc;
        $data->brand_status = $request->brand_status;
        $data->brand_image = $request->brand_image;
        // $token = JWTAuth::attempt($data->brand_name);
        // echo $token;
        $data->save();
        return redirect()->back()->with('thongbao', 'Thêm thương hiệu sản phẩm thành công');

    }

//all_brand_product
    public function allBrandProduct(){
        $allbrand = brand_product::paginate(4);
        return view('admin.brand.all_brand_product', compact('allbrand'));
    }
//edit_brand_product
    public function editBrandProduct(Request $request ,$brand_id){
        $edit_brand = brand_product::findOrFail($brand_id);
        return view('admin.brand.edit_brand_product', compact('edit_brand'));
    }
    public function updateBrandProduct(updateBrand $request ,$brand_id){
        $edit_brand= brand_product::findOrFail($brand_id);
        $edit_brand->brand_name = $request->brand_name;
        $edit_brand->brand_desc = $request->brand_desc;
        $edit_brand->brand_image = $request->brand_image;
        $edit_brand->save();
        return redirect()->route('allbrandproduct')->with('message', 'Cập nhật thương hiệu thành công');
    }

//delete_brand_product
    public function deleteBrandProduct($brand_id){
        $delete_brand = brand_product::findOrFail($brand_id);
        $delete_brand->delete();
        return redirect()->route('allbrandproduct')->with('message', 'Bạn đã xóa danh mục sản phẩm thành công');
    }

    public function viewBrand($brand_name){
        $allcategory = category_product::get();
        $allbrand = brand_product::get();
        $brand_by_id = DB::table('products')->join('brand_products', 'products.brand_id', '=', 'brand_products.brand_name')->where('brand_products.brand_name', $brand_name)->get();
        return view('users.brand')->with('allcategory', $allcategory)->with('allbrand', $allbrand)->with('brand_by_id', $brand_by_id);
        }

//active and unactive
    public function activeBrand($brand_id){
        $active = DB::table('brand_products')->where('brand_id', $brand_id)->update(['brand_status'=>0]);
        return redirect()->route('allbrandproduct')->with('mess', 'Không kích hoạt sản phẩm');
    }
    public function unactiveBrand($brand_id){
        $unactive = DB::table('brand_products')->where('brand_id', $brand_id)->update(['brand_status'=>1]);
        return redirect()->route('allbrandproduct')->with('mess', 'Kích hoạt sản phẩm');
    }


















    }



