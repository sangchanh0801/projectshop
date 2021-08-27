<?php

namespace App\Http\Controllers;

use App\Http\Requests\saveCategoryPost;
use App\Http\Requests\updateCategoryPost;
use App\Models\brand_product;
use App\Models\category_post;
use App\Models\category_product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryPost extends Controller
{
//add_brand_product
public function addCategoryPost(){
    return view('admin.category_post.add_category_post');
}
public function saveCategoryPost(saveCategoryPost $request){
    $data = new category_post();
    $data->category_post_name = $request->category_post_name;
    $data->category_post_slug = $request->category_post_slug;
    $data->category_post_desc = $request->category_post_desc;
    $data->category_post_status = $request->category_post_status;
    $data->save();
    return redirect()->back()->with('thongbao', 'Thêm danh mục bài viết thành công');

}

//all_brand_product

public function allCategoryPost(){
    $allcategorypost = category_post::paginate(4);
    return view('admin.category_post.all_category_post', compact('allcategorypost'));
}
//edit_brand_product
public function editCategoryPost(Request $request ,$category_post_id){
    $edit_category_post = category_post::findOrFail($category_post_id);
    return view('admin.category_post.edit_category_post', compact('edit_category_post'));

}
public function updateCategoryPost(updateCategoryPost $request ,$category_post_id){
    $edit_category_post= category_post::findOrFail($category_post_id);
    $edit_category_post->category_post_name = $request->category_post_name;
    $edit_category_post->category_post_slug = $request->category_post_slug;
    $edit_category_post->category_post_desc = $request->category_post_desc;
    $edit_category_post->category_post_status = $request->category_post_status;
    $edit_category_post->save();
    return redirect()->route('allcategorypost')->with('message', 'Cập nhật danh mục bài viết thành công');
}

//delete_brand_product
public function deleteCategoryPost($category_post_id){
    $delete_category_post = category_post::findOrFail($category_post_id);
    $delete_category_post->delete();
    return redirect()->route('allcategorypost')->with('message', 'Bạn đã xóa danh mục bài viết thành công');
}



//active and unactive
    public function activeCategoryPost($category_post_id){
        $active = DB::table('category_posts')->where('category_post_id', $category_post_id)->update(['category_post_status'=> '0']);
        return redirect()->route('allcategorypost')->with('mess', 'Không kích hoạt danh mục bài viết');
    }
    public function unactiveCategoryPost($category_post_id){
        $unactive = DB::table('category_posts')->where('category_post_id', $category_post_id)->update(['category_post_status'=> '1']);
        return redirect()->route('allcategorypost')->with('mess', 'Kích hoạt danh mục bài viết');
    }













}
