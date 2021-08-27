<?php

namespace App\Http\Controllers;

use App\Models\product_comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductCommentController extends Controller
{
    public function allProductComment(){
        $allcomment = product_comment::join('users', 'users.id', 'product_comments.user_id')
                                    ->join('products', 'products.product_id', 'product_comments.product_id')
                                    ->select('users.name', 'products.product_name', 'product_comments.*')->get();
        return view('admin.comment.all_comment_product', compact('allcomment'));
    }
    public function activeProductComment($comment_id){
        DB::table('product_comments')->where('id', $comment_id)->update(['product_comment_status'=> 0]);
       return redirect()->route('allproductcomment')->with('mess', 'Không kích hoạt bình luận');
   }
   public function unactiveProductComment($comment_id){
       DB::table('product_comments')->where('id', $comment_id)->update(['product_comment_status'=>1]);
       return redirect()->route('allproductcomment')->with('mess', 'Kích hoạt bình luận');
   }
   public function editProductComment(Request $request ,$comment_id){
    $edit_comment = product_comment::findOrFail($comment_id);
    return view('admin.comment.edit_comment_product', compact('edit_comment'));
    }
    public function updateProductComment(Request $request, $comment_id){
        $comment = product_comment::findOrFail($comment_id);
        $comment->product_comment = $request->product_comment;
        $comment->product_comment_status = $request->product_comment_status;
        $comment->save();
        return redirect()->route('allproductcomment')->with('mess', 'Cập nhật bình luận thành công');
    }
    public function deleteProductComment($comment_id){
        $comment = product_comment::findOrFail($comment_id);
        $comment->delete();
        return redirect()->route('allproductcomment')->with('mess', 'Xóa bình luận thành công');
    }
}
