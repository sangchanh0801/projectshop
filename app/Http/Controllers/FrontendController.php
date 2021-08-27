<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\banner;
use App\Models\brand_product;
use App\Models\category_post;
use App\Models\category_product;
use App\Models\Gallery;
use App\Models\post;
use App\Models\post_comment;
use App\Models\product;
use App\Models\product_comment;
use App\Models\rating;
use App\Models\role_user;
use App\Models\User;
use App\Models\UserVerify;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
// use Illuminate\Auth\Notifications\VerifyEmail;
class FrontendController extends Controller
{

    public function viewHome(){
        $allproduct = product::where('product_status', '1')->get();
        $allbrand = brand_product::where('brand_status', '1')->get();
        $category_post = category_post::where('category_post_status', '1')->get();
        $relate_product = product::take(4)->get();
        $allcategory = category_product::where('category_status', '1')->take(4)->get();
        $allbanner = banner::where('banner_status', '1')->get();
        $allpost = post::where('post_status', 1)->take(4)->get();
        return view('frontend.home' ,compact('allproduct', 'allbrand', 'allcategory','relate_product', 'category_post', 'allbanner','allpost'));
    }
    public function search(Request $request){
        $key_word = $request->search;
        $allbrand = brand_product::where('brand_status', '1')->get();
        $allcategory = category_product::where('category_status', '1')->get();
        $category_post = category_post::where('category_post_status', '1')->get();
        $relate_product = product::take(4)->get();
        $search_product = DB::table('products')->where('product_name', 'like', '%'.$key_word. '%')->where('product_status', '1')->paginate(4);
        return view('frontend.pages.search', compact('search_product','allbrand','relate_product', 'allcategory','category_post'));
    }


//category_product
    public function viewCategory($category_slug){
        $allbrand = brand_product::where('brand_status', '1')->get();
        $allcategory = category_product::where('category_status', '1')->get();
        $category_post = category_post::where('category_post_status', '1')->get();
        $relate_product = product::take(4)->get();
        $cate_by_slug = category_product::where('category_slug', $category_slug)->get();
        $max = product::max('product_price') + 100000;
        $min = product::min('product_price') - 10000;
        foreach($cate_by_slug as $cates){
            $category_id = $cates->category_id;
        }
        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];

            if ($sort_by == 'asc') {
                $all_product_category = product::with('category')
                                        ->where('category_id', $category_id)
                                        ->where('product_status', 1)->orderBy('product_price', 'ASC')->paginate(6)->appends(request()->query());
            }elseif($sort_by == 'desc'){
                $all_product_category = product::with('category')
                                        ->where('category_id', $category_id)
                                        ->where('product_status', 1)->orderBy('product_price', 'DESC')->paginate(6)->appends(request()->query());
            }elseif($sort_by == 'kytu_az'){
                $all_product_category = product::with('category')
                                        ->where('category_id', $category_id)
                                        ->where('product_status', 1)->orderBy('product_name', 'ASC')->paginate(6)->appends(request()->query());
            }elseif($sort_by == 'kytu_za')
                $all_product_category = product::with('category')
                                        ->where('category_id', $category_id)
                                        ->where('product_status', 1)->orderBy('product_name', 'DESC')->paginate(6)->appends(request()->query());
            }elseif(isset($_GET['start_price']) && ($_GET['end_price'])){
                $min_price  = $_GET['start_price'];
                $max_price = $_GET['end_price'];
                $all_product_category = product::with('category')
                                        ->whereBetween('product_price', [$min_price, $max_price])
                                        ->where('product_status', 1)->orderBy('product_id', 'DESC')->paginate(6)->appends(request()->query());
            }else{
                $all_product_category = product::with('category')
                                        ->where('category_id', $category_id)
                                        ->where('product_status', 1)->orderBy('product_id', 'DESC')->paginate(6);
            }

        return view('frontend.pages.category', compact('allbrand','allcategory','relate_product','all_product_category', 'category_post', 'max', 'min'));
    }
//brand-product
    public function viewBrands($brand_name){
        $allbrand = brand_product::where('brand_status', '1')->get();
        $allcategory = category_product::where('category_status', '1')->get();
        $category_post = category_post::where('category_post_status', '1')->get();
        $relate_product = product::take(4)->get();
        $all_product_brand = product::join('brand_products', 'brand_products.brand_id','products.brand_id')->where('brand_products.brand_name', $brand_name)->where('products.product_status', 1)->paginate(9);
        return view('frontend.pages.brand', compact('allbrand','allcategory','relate_product','all_product_brand', 'category_post'));
    }
//details-product
public function detailProduct($product_id){
    $allbrand = brand_product::where('brand_status', '1')->get();
    $allcategory = category_product::where('category_status', '1')->get();
    $category_post = category_post::where('category_post_status', '1')->get();
    $relate_product = product::take(4)->get();
    $detail_product = product::join('category_products', 'category_products.category_id', '=', 'products.category_id')
                            ->join('brand_products', 'brand_products.brand_id', '=','products.brand_id')
                            ->where('product_status', '1')->where('product_id', $product_id)
                            ->get();
    foreach ($detail_product as $key => $value) {
        $category_id = $value->category_id;
        $product_id = $value->product_id;
    }
    $rating = rating::where('product_id', $product_id)->avg('rating');
    $rating = round($rating);
    $gallery = Gallery::where('product_id', $product_id)->get();
    $relate_product = product::join('category_products', 'category_products.category_id', '=', 'products.category_id')
                            ->join('brand_products', 'brand_products.brand_id', '=','products.brand_id')
                            ->where('product_status', '1')->where('category_products.category_id', $category_id)
                            ->get();
    return view('frontend.pages.detail-product', compact('allbrand', 'allcategory','relate_product', 'detail_product', 'relate_product', 'category_post', 'gallery', 'rating'));

}
//LOGIN-CUSTOMER
        public function loginCheckout(){
            $allcategory = category_product::where('category_status', '1')->get();
            $category_post = category_post::where('category_post_status', '1')->get();
            return view('frontend.pages.login_customer', compact('allcategory', 'category_post'));
        }
        public function addCustomer(Request $request){
            $newUser = new CreateNewUser();
            $user = $newUser->create($request->only(['name', 'email', 'password', 'password_confirmation']));
            $user->roles()->sync('4');
            $token = JWTAuth::attempt($request->only(['email', 'password']));
            UserVerify::create([
                'user_id' => $user->id,
                'token' => $token
                ]);
            Mail::send('verify-email', ['token' => $token], function($message) use($request){
                $message->to($request->email);
                $message->from($request->email);
                $message->subject('Email xác thực tài khoản của bạn');
            });
            return redirect()->back()->with('mess', 'Đăng kí tài khoản thành công, vui lòng kiểm tra email để xác thực tài khoản');
        }
        public function verifyAccount($token)
        {
            $verifyUser = UserVerify::where('token',$token)->first();
            $message = 'Xin lỗi, email của bạn không xác định được';
            if(!is_null($verifyUser) ){
                $user = $verifyUser->user;
                if(!$user->email_verified_at) {
                    $verifyUser->user->email_verified_at = Carbon::now();
                    $verifyUser->user->save();
                    $message = "E-mail của bạn đã được xác minh. Bây giờ bạn có thể đăng nhập.";
                } else {
                    $message = "E-mail của bạn đã được xác minh. Bây giờ bạn có thể đăng nhập.";
                }
            }
          return redirect()->route('logincheckout')->with('message', $message);
        }
        public function loginCustomer(Request $request){
                $email = $request->input('email');
                $password = $request->input('password');
                if (Auth::attempt(['email' => $email, 'password' => $password])) {
                    $user = User::where('email' ,$email)->first();
                    if ($user->email_verified_at == null) {
                        $UserVerify = UserVerify::where('user_id', $user->id)->first();
                        if (!empty($UserVerify->token)) {
                            Mail::send('verify-email', ['token' => $UserVerify->token], function($message) use($request){
                                $message->to($request->email);
                                $message->from($request->email);
                                $message->subject('Email xác thực tài khoản của bạn');
                            });
                        }else{
                            $token = JWTAuth::attempt($request->only(['email', 'password']));
                            UserVerify::create([
                                'user_id' => $user->id,
                                'token' => $token
                                ]);
                            Mail::send('verify-email', ['token' => $token], function($message) use($request){
                                $message->to($request->email);
                                $message->from($request->email);
                                $message->subject('Email xác thực tài khoản của bạn');
                        });
                        }
                        Auth::logout();
                        return redirect()->route('logincheckout')->with('message', 'Bạn cần xác nhận tài khoản của mình. Chúng tôi đã gửi cho bạn một mã kích hoạt, vui lòng kiểm tra email của bạn.');
                    }else{
                        Auth::login($user);
                        return redirect()->route('showcheckout');
                    }
                }else
                    return redirect()->back()->with('message' ,'Tài khoản hoặc mật khẩu không đúng');
        }
        public function logoutCustomer(){
            Auth::logout();
            return redirect()->route('viewhome');
}

//POST
    public function viewCategoryPost(Request $request, $category_post_slug){
        $allcategory = category_product::get();
        $allbrand = brand_product::get();
        $relate_product = product::take(4)->get();
        $category_post = category_post::where('category_post_status', '1')->get();
        $allpost = post::take(4)->get();
        $cate_post = category_post::where('category_post_slug', $category_post_slug)->where('category_post_status', 1)->first();
        $posts = post::with('cate_post')->where('post_status', 1)->where('cate_post_id', $cate_post->category_post_id)->paginate(3);
        return view('frontend.pages.category_post', compact('allcategory', 'allbrand' ,'relate_product', 'category_post', 'posts'));

    }
    public function viewPost(Request $request,$post_slug){
        $allcategory = category_product::get();
        $allbrand = brand_product::get();
        $relate_product = product::take(4)->get();
        $category_post = category_post::where('category_post_status', '1')->get();
        $post = post::where('post_slug', $post_slug)->where('post_status', '1')->first();
        return view('frontend.pages.detail-post', compact('allcategory','relate_product','allbrand','category_post','post'));
    }

    public function loadComment(Request $request){
        $post_id = $request->post_id;
        $comments=post_comment::join('users', 'users.id', 'post_comments.user_id')->where('post_id', $post_id)
                                ->select('users.*', 'post_comments.*')->where('post_comment_status', 1)->get();
        $output= '';
        foreach($comments as $comment){
            if ($comment->avatar) {
                $avatar = $comment->avatar;
            }else{
                $avatar= 'avatar.png';
            }
            $output.= '<div class="display-comment">
            <div class="comment-list">
                <div class="single-comment">
                    <img src="'.url('public/Profile/'.$avatar.'').'" alt="">
                    <div class="content">
                    <h4>'.$comment->name.'<span>At '.$comment->created_at->format('g: i a').' On '.$comment->created_at->format('M d Y').'</span></h4>
                        <p>'.$comment->post_comment.'</p>
                    </div>
                </div>
            </div>
        </div>';
        }
        echo $output;
    }

    public function sendComment(Request $request){
        $data = $request->all();
        $comment = new post_comment();
        $comment->post_comment = $data['comment_content'];
        $comment->post_id = $data['post_id'];
        $comment->post_comment_status = 1;
        $comment->user_id = Auth::user()->id;
        $comment->save();
    }

    public function loadProductComment(Request $request){
        $product_id = $request->product_id;
        $comments=product_comment::join('users', 'users.id', 'product_comments.user_id')->where('product_id', $product_id)
                                ->select('users.*', 'product_comments.*')->get();
        $put= '';
        foreach($comments as $comment){
            $put.= '<div class="reviews-submitted">
            <div class="reviewer">'.$comment->name.' - <span>'.$comment->created_at.'</span></div>
            <p>
                '.$comment->product_comment.'
            </p>
        </div>';
        }
        echo $put;
    }
    public function sendProductComment(Request $request){
        $data = $request->all();
        $comment = new product_comment();
        $comment->product_comment = $data['product_comment'];
        $comment->product_id = $data['product_id'];
        $comment->product_comment_status = 1;
        $comment->user_id = Auth::user()->id;
        $comment->save();
    }

    public function insertRating(Request $request){
        $data = $request->all();
        $rating = new rating();
        $rating->rating = $data['index'];
        $rating->product_id = $data['product_id'];
        $rating->save();
        echo 'done';
    }










}
