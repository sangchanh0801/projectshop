<?php

namespace App\Http\Controllers;

use App\Models\post_comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostCommentController extends Controller
{
    public function allComment(){
        $allcomment = post_comment::join('users', 'users.id', 'post_comments.user_id')
                                    ->join('posts', 'posts.post_id', 'post_comments.post_id')
                                    ->select('users.name', 'posts.post_title', 'post_comments.*')->get();
        return view('admin.comment.all_comment', compact('allcomment'));
    }
    public function activeComment($comment_id){
        DB::table('post_comments')->where('id', $comment_id)->update(['post_comment_status'=> 0]);
       return redirect()->route('allcomment')->with('mess', 'Không kích hoạt bình luận');
   }
   public function unactiveComment($comment_id){
       DB::table('post_comments')->where('id', $comment_id)->update(['post_comment_status'=>1]);
       return redirect()->route('allcomment')->with('mess', 'Kích hoạt bình luận');
   }
   public function editComment(Request $request ,$comment_id){
    $edit_comment = post_comment::findOrFail($comment_id);
    return view('admin.comment.edit_comment', compact('edit_comment'));
    }
    public function updateComment(Request $request, $comment_id){
        $comment = post_comment::findOrFail($comment_id);
        $comment->post_comment = $request->post_comment;
        $comment->post_comment_status = $request->post_comment_status;
        $comment->save();
        return redirect()->route('allcomment')->with('mess', 'Cập nhật bình luận thành công');
    }
    public function deleteComment($comment_id){
        $comment = post_comment::findOrFail($comment_id);
        $comment->delete();
        return redirect()->route('allcomment')->with('mess', 'Xóa bình luận thành công');
    }



}
