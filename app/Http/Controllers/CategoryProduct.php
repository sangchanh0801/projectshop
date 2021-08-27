<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveCategory;
use App\Http\Requests\updateCategory;
use App\Models\brand_product;
use App\Models\category_post;
use App\Models\category_product;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryProduct extends Controller
{
//add_category_product
    public function addCategoryProduct(){
        return view('admin.category_product.add_category_product');
    }
    public function saveCategory(saveCategory $request){
        $data = new category_product();
        $data->category_name = $request->category_name;
        $data->category_slug = $request->category_slug;
        $data->category_desc = $request->category_desc;
        $data->category_status = $request->category_status;
        $data->save();
        return redirect()->route('allcategoryproduct')->with('mess', 'Thêm danh mục sản phẩm thành công');
    }

//all_category_product

    public function allCategoryProduct(){
        $allcategory = category_product::paginate(5);
        return view('admin.category_product.all_category_product', compact('allcategory'));
    }
//edit_categorry_product
    public function editCategoryProduct(Request $request ,$category_id){
        $edit_category = category_product::findOrFail($category_id);
        return view('admin.category_product.edit_category_product', compact('edit_category'));

    }
    public function updateCategoryProduct(updateCategory $request ,$category_id){
        $edit_category = category_product::findOrFail($category_id);
        $edit_category->category_name = $request->category_name;
        $edit_category->category_slug = $request->category_slug;
        $edit_category->category_desc = $request->category_desc;
        $edit_category->save();
        return redirect()->route('allcategoryproduct')->with('mess', 'Cập nhật danh mục thành công');
    }
//delete_category_product
    public function deleteCategoryProduct($category_id){
        $delete_category = category_product::findOrFail($category_id);
        $delete_category->delete();
        return redirect()->route('allcategoryproduct')->with('mess', 'Bạn đã xóa danh mục sản phẩm thành công');
    }
//active and unactive
    public function activeCategory($category_id){
        $active = DB::table('category_products')->where('category_id', $category_id)->update(['category_status'=>0]);
        return redirect()->route('allcategoryproduct')->with('mess', 'Không kích hoạt danh mục sản phẩm');
    }
    public function unactiveCategory($category_id){
        $unactive = DB::table('category_products')->where('category_id', $category_id)->update(['category_status'=>1]);
        return redirect()->route('allcategoryproduct')->with('mess', 'Kích hoạt danh mục sản phẩm');
    }


























}
