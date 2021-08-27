<?php

namespace App\Http\Controllers;

use App\Models\category_post;
use App\Models\post;
use App\Models\PostTag;
use App\Models\role_user;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function addPost(){
        $cate_post = category_post::orderBy('category_post_id', 'DESC')->get();
        $post_tag = PostTag::where('tag_status', 1)->get();
        $users = role_user::join('users','users.id', 'role_user.user_id')->where('role_id', 4)->select('users.*')->get();
        return view('admin.post.add_post', compact('cate_post', 'post_tag', 'users'));
    }
    public function savePost(Request $request){
        $data = $request->all();
        $post = new post();
        $post->post_title =$data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_author = $data['post_author'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];
        $post_tag=$request->input('post_tag');
        if($post_tag){
            $data['post_tag']=implode(',',$post_tag);
        }
        else{
            $data['post_tag']='';
        }
        $post->post_tag = $data['post_tag'];
        $post->post_image = $data['post_image'];
        $post->save();
        return redirect()->route('allpost')->with('mess', 'Thêm bài viết thành công');

    }
// //all_brand_product

    public function allPost(){
        $allpost = post::join('category_posts', 'category_posts.category_post_id', '=', 'posts.cate_post_id')
                             ->select(['posts.*','category_posts.category_post_name'])
                            ->paginate(3);

        return view('admin.post.all_post', compact('allpost'));
    }
//edit_product
    public function editPost(Request $request ,$post_id){
        $cate_post = category_post::get();
        $post_tag = PostTag::where('tag_status', 1)->get();
        $users = role_user::join('users','users.id', 'role_user.user_id')->where('role_id', 4)->select('users.*')->get();
        $edit_post = post::findOrFail($post_id);
        return view('admin.post.edit_post', compact('edit_post','cate_post', 'post_tag', 'users'));

    }
    public function updatePost(Request $request, $post_id){
        $data = $request->all();
        $post = post::findOrFail($post_id);
        $post->post_title =$data['post_title'];
        $post->post_slug = $data['post_slug'];
        $post->post_author = $data['post_author'];
        $post->post_desc = $data['post_desc'];
        $post->post_content = $data['post_content'];
        $post->cate_post_id = $data['cate_post_id'];
        $post->post_status = $data['post_status'];
        $post->post_image = $data['post_image'];
        $post_tag=$request->input('post_tag');
        if($post_tag){
            $data['post_tag']=implode(',',$post_tag);
        }
        else{
            $data['post_tag']='';
        }
        $post->post_tag = $data['post_tag'];
        $post->save();
        return redirect()->route('allpost')->with('mess', 'Cập nhật bài viết thành công');

    }
//     //delete_product
    public function deletePost($post_id){
        $delete_post = post::findOrFail($post_id);
        $delete_post->delete();
        return redirect()->route('allpost')->with('mess', 'Bạn đã xóa bài viết thành công');
    }
// //active and unactive
    public function activePost($post_id){
         DB::table('posts')->where('post_id', $post_id)->update(['post_status'=> 0]);
        return redirect()->route('allpost')->with('mess', 'Không kích hoạt bài viết');
    }
    public function unactivePost($post_id){
        DB::table('posts')->where('post_id', $post_id)->update(['post_status'=>1]);
        return redirect()->route('allpost')->with('mess', 'Kích hoạt bài viết');
    }












}
