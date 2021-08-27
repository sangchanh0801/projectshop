<?php

namespace App\Http\Controllers;
use App\Models\brand_product;
use Illuminate\Http\Request;
use App\Http\Requests\saveBrand;
use App\Http\Requests\updateBrand;
use App\Models\category_post;
use App\Models\category_product;
use App\Models\PostTag;
use App\Models\product;
use Illuminate\Support\Facades\DB;

class PostTagController extends Controller
{
//add_tag
    public function addTag(){
        return view('admin.tags.add_tags');
    }
    public function saveTag(Request $request){
        $data = new PostTag();
        $data->tag_name = $request->tag_name;
        $data->tag_slug = $request->tag_slug;
        $data->tag_status = $request->tag_status;
        $data->save();
        return redirect()->route('alltag')->with('mess', 'Thêm tag thành công');
    }

//all_tag

    public function allTag(){
        $alltag = PostTag::paginate(4);
        return view('admin.tags.all_tags', compact('alltag'));
    }
//edit_tag
    public function editTag(Request $request ,$tag_id){
        $edit_tag = PostTag::findOrFail($tag_id);
        return view('admin.tags.edit_tags', compact('edit_tag'));

    }
    public function updateTag(Request $request ,$tag_id){
        $edit_tag= PostTag::findOrFail($tag_id);
        $edit_tag->tag_name = $request->tag_name;
        $edit_tag->tag_slug = $request->tag_slug;
        $edit_tag->tag_status = $request->tag_status;
        $edit_tag->save();
        return redirect()->route('alltag')->with('mess', 'Cập nhật tags thành công');
    }

//delete_tag
    public function deleteTag($tag_id){
        $delete_tag = PostTag::findOrFail($tag_id);
        $delete_tag->delete();
        return redirect()->route('alltag')->with('mess', 'Bạn đã xóa tag thành công');
    }

//active and unactive
    public function activeTag($tag_id){
        $active = DB::table('post_tags')->where('tag_id', $tag_id)->update(['tag_status'=>0]);
        return redirect()->route('alltag')->with('mess', 'Không kích hoạt tag');
    }
    public function unactiveTag($tag_id){
        $unactive = DB::table('post_tags')->where('tag_id', $tag_id)->update(['tag_status'=>1]);
        return redirect()->route('alltag')->with('mess', 'Kích hoạt tag');
    }





















}
