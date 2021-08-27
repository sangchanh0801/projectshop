<?php

use App\Http\Controllers\AdminController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Notifications\VerifyEmail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/clear-cache', function(){
// $exitCode = Artisan::call('cache:clear');
// });
//Login
Route::get('/login', 'App\Http\Controllers\AdminController@showLogin')->name('login');
Route::post('/login', 'App\Http\Controllers\AdminController@checkLogin')->name('checklogin');
//Logout
Route::get('/logout', 'App\Http\Controllers\AdminController@logout')->name('logout');
//Trang chu
Route::group(['middleware' =>['auth'], 'prefix'=> 'admin'], function(){
    Route::get('dashboard', 'App\Http\Controllers\AdminController@showdashboard')->name('dashboard');
    Route::post('filter_by_day', 'App\Http\Controllers\AdminController@filterByDay')->name('filterbyday');
    Route::post('dashboard_filter', 'App\Http\Controllers\AdminController@dashboard_filter')->name('dashboardfilter');
    Route::post('day_filter', 'App\Http\Controllers\AdminController@day_filter')->name('dayfilter');
// Profile
    Route::get('/profile','App\Http\Controllers\AdminController@profile')->name('profile');
    Route::post('/profile/{id}','App\Http\Controllers\AdminController@updateProfile')->name('updateprofile');
});

Route::group(['middleware' =>['auth', 'auth.Maneger'], 'prefix'=> 'admin'], function(){
//category_product
    Route::get('add_category_product', 'App\Http\Controllers\CategoryProduct@addCategoryProduct')->name('addcategoryproduct');
    Route::get('all_category_product', 'App\Http\Controllers\CategoryProduct@allCategoryProduct')->name('allcategoryproduct');
    Route::get('edit_category_product/{category_id}', 'App\Http\Controllers\CategoryProduct@editCategoryProduct')->name('editcategoryproduct');
    Route::post('add_category_product', 'App\Http\Controllers\CategoryProduct@saveCategory')->name('savecategory');
    Route::post('update_category_product/{category_id}', 'App\Http\Controllers\CategoryProduct@updateCategoryProduct')->name('updatecategoryproduct');
    Route::get('delete_category_product/{category_id}', 'App\Http\Controllers\CategoryProduct@deleteCategoryProduct')->name('deletecategoryproduct');
    Route::get('active_category/{category_id}', 'App\Http\Controllers\CategoryProduct@activeCategory')->name('activeCategory');
    Route::get('unactive_category/{category_id}', 'App\Http\Controllers\CategoryProduct@unactiveCategory')->name('unactiveCategory');
//brand_product
    Route::get('add_brand_product', 'App\Http\Controllers\BrandProduct@addBrandProduct')->name('addbrandproduct');
    Route::get('all_brand_product', 'App\Http\Controllers\BrandProduct@allBrandProduct')->name('allbrandproduct');
    Route::get('edit_brand_product/{brand_id}', 'App\Http\Controllers\BrandProduct@editBrandProduct')->name('editbrandproduct');
    Route::post('add_brand_product', 'App\Http\Controllers\BrandProduct@saveBrand')->name('savebrand');
    Route::post('update_brand_product/{brand_id}', 'App\Http\Controllers\BrandProduct@updateBrandProduct')->name('updatebrandproduct');
    Route::get('delete_brand_product/{brand_id}', 'App\Http\Controllers\BrandProduct@deleteBrandProduct')->name('deletebrandproduct');
    Route::get('active_brand/{brand_id}', 'App\Http\Controllers\BrandProduct@activeBrand')->name('activeBrand');
    Route::get('unactive_brand/{brand_id}', 'App\Http\Controllers\BrandProduct@unactiveBrand')->name('unactiveBrand');
//product
    Route::get('add_product', 'App\Http\Controllers\Products@addProduct')->name('addproduct');
    Route::get('all_product', 'App\Http\Controllers\Products@allProduct')->name('allproduct');
    Route::get('edit_product/{product_id}', 'App\Http\Controllers\Products@editProduct')->name('editproduct');
    Route::post('add_product', 'App\Http\Controllers\Products@saveProduct')->name('saveproduct');
    Route::post('update_product/{product_id}', 'App\Http\Controllers\Products@updateProduct')->name('updateproduct');
    Route::get('delete_product/{product_id}', 'App\Http\Controllers\Products@deleteProduct')->name('deleteproduct');
    Route::get('/active_product/{product_id}', 'App\Http\Controllers\Products@activeProduct')->name('activeProduct');
    Route::get('/unactive_product/{product_id}', 'App\Http\Controllers\Products@unactiveProduct')->name('unactiveProduct');
    Route::get('add_gallery/{product_id}', 'App\Http\Controllers\Products@addGallery')->name('addgallery');
    Route::post('select_gallery', 'App\Http\Controllers\Products@selectGallery')->name('selectgallery');
    Route::post('insert_gallery/{pro_id}', 'App\Http\Controllers\Products@insertGallery')->name('insertgallery');
    Route::post('update_gallery', 'App\Http\Controllers\Products@updateGallery')->name('updategallery');
    Route::post('delete_gallery', 'App\Http\Controllers\Products@deleteGallery')->name('deletegallery');


//manege_order
    Route::get('all_manege_order', 'App\Http\Controllers\OrderController@manegeOrder')->name('manegeoder');
    Route::get('view_order/{order_code}', 'App\Http\Controllers\OrderController@viewOrder')->name('vieworder');
    Route::post('update_order', 'App\Http\Controllers\OrderController@updateOrder')->name('updateorder');
//phi van chuyen
    Route::get('delivery', 'App\Http\Controllers\DeliveryController@insertDelivery')->name('insertdelivery');
    Route::post('/selectdelivery', 'App\Http\Controllers\DeliveryController@selectDelivery')->name('selectdelivery');
    Route::post('/add-feeship', 'App\Http\Controllers\DeliveryController@addFeeship')->name('addfeeship');
    Route::post('/selectfeeship', 'App\Http\Controllers\DeliveryController@selectFeeship')->name('selectfeeship');
    Route::post('/updatefeeship', 'App\Http\Controllers\DeliveryController@updateFeeship')->name('updatefeeship');

});

//USER--coupon
Route::group(['middleware' =>['auth', 'auth.isAdmin'], 'prefix'=> 'admin'], function(){
//User
    Route::get('all_user', 'App\Http\Controllers\UserController@allUser')->name('alluser');
    Route::get('edit_user/{id}', 'App\Http\Controllers\UserController@editUser')->name('edituser');
    Route::post('update_user/{id}', 'App\Http\Controllers\UserController@updateUser')->name('updateuser');
    Route::get('delete_user/{id}', 'App\Http\Controllers\UserController@deleteUser')->name('deleteuser');
    Route::get('add_user', 'App\Http\Controllers\UserController@addUser')->name('adduser');
    Route::post('save_user', 'App\Http\Controllers\UserController@saveUser')->name('saveuser');
//setting
    Route::get('/setting', 'App\Http\Controllers\AdminController@settings')->name('settings');
    Route::post('/update-setting', 'App\Http\Controllers\AdminController@updateSetting')->name('updatesetting');

//Coupon
    Route::get('add_coupon', 'App\Http\Controllers\CouponController@addCoupon')->name('addcoupon');
    Route::post('save_coupon', 'App\Http\Controllers\CouponController@saveCoupon')->name('savecoupon');
    Route::get('all_coupon', 'App\Http\Controllers\CouponController@allCoupon')->name('allcoupon');
    Route::get('edit_coupon/{coupon_id}', 'App\Http\Controllers\CouponController@editCoupon')->name('editcoupon');
    Route::post('update_coupon/{coupon_id}', 'App\Http\Controllers\CouponController@updateCoupon')->name('updatecoupon');
    Route::get('delete_coupon/{coupon_id}', 'App\Http\Controllers\CouponController@deleteCoupon')->name('deletecoupon');
    Route::get('active_coupon/{coupon_id}', 'App\Http\Controllers\CouponController@activeCoupon')->name('activecoupon');
    Route::get('unactive_coupon/{coupon_id}', 'App\Http\Controllers\CouponController@unactiveCoupon')->name('unactivecoupon');
//banner
    Route::get('add_banner', 'App\Http\Controllers\BannerController@addBanner')->name('addbanner');
    Route::get('all_banner', 'App\Http\Controllers\BannerController@allBanner')->name('allbanner');
    Route::get('edit_banner/{banner_id}', 'App\Http\Controllers\BannerController@editBanner')->name('editbanner');
    Route::post('save_banner', 'App\Http\Controllers\BannerController@saveBanner')->name('savebanner');
    Route::post('update_banner/{banner_id}', 'App\Http\Controllers\BannerController@updateBanner')->name('updatebanner');
    Route::get('delete_banner/{banner_id}', 'App\Http\Controllers\BannerController@deleteBanner')->name('deletebanner');
    Route::get('active_banner/{banner_id}', 'App\Http\Controllers\BannerController@activeBanner')->name('activebanner');
    Route::get('unactive_banner/{banner_id}', 'App\Http\Controllers\BannerController@unactiveBanner')->name('unactivebanner');

});
//CATEGORY_POST
Route::group(['middleware' =>['auth', 'auth.Author'], 'prefix'=> 'admin'], function(){
//CATEGORY_POST
    Route::get('all_category_post', 'App\Http\Controllers\CategoryPost@allCategoryPost')->name('allcategorypost');
    Route::get('edit_category_post/{category_post_id}', 'App\Http\Controllers\CategoryPost@editCategoryPost')->name('editcategorypost');
    Route::post('update_category_post/{category_post_id}', 'App\Http\Controllers\CategoryPost@updateCategoryPost')->name('updatecategorypost');
    Route::get('delete_category_post/{category_post_id}', 'App\Http\Controllers\CategoryPost@deleteCategoryPost')->name('deletecategorypost');
    Route::get('add_category_post', 'App\Http\Controllers\CategoryPost@addCategoryPost')->name('addcategorypost');
    Route::post('save_category_post', 'App\Http\Controllers\CategoryPost@saveCategoryPost')->name('savecategorypost');
    Route::get('active_category_post/{category_post_id}', 'App\Http\Controllers\CategoryPost@activeCategoryPost')->name('activecategorypost');
    Route::get('unactive_category_post/{category_post_id}', 'App\Http\Controllers\CategoryPost@unactiveCategoryPost')->name('unactivecategorypost');

//POST
    Route::get('all_post', 'App\Http\Controllers\PostController@allPost')->name('allpost');
    Route::get('edit_post/{post_id}', 'App\Http\Controllers\PostController@editPost')->name('editpost');
    Route::post('update_post/{post_id}', 'App\Http\Controllers\PostController@updatePost')->name('updatepost');
    Route::get('delete_post/{post_id}', 'App\Http\Controllers\PostController@deletePost')->name('deletepost');
    Route::get('add_post', 'App\Http\Controllers\PostController@addPost')->name('addpost');
    Route::post('save_post', 'App\Http\Controllers\PostController@savePost')->name('savepost');
    Route::get('active_post/{post_id}', 'App\Http\Controllers\PostController@activePost')->name('activepost');
    Route::get('unactive_post/{post_id}', 'App\Http\Controllers\PostController@unactivePost')->name('unactivepost');
//Tag
    Route::get('all_tag', 'App\Http\Controllers\PostTagController@allTag')->name('alltag');
    Route::get('edit_tag/{tag_id}', 'App\Http\Controllers\PostTagController@editTag')->name('edittag');
    Route::post('update_tag/{tag_id}', 'App\Http\Controllers\PostTagController@updateTag')->name('updatetag');
    Route::get('delete_tag/{tag_id}', 'App\Http\Controllers\PostTagController@deleteTag')->name('deletetag');
    Route::get('add_tag', 'App\Http\Controllers\PostTagController@addTag')->name('addtag');
    Route::post('save_tag', 'App\Http\Controllers\PostTagController@saveTag')->name('savetag');
    Route::get('active_tag/{tag_id}', 'App\Http\Controllers\PostTagController@activeTag')->name('activetag');
    Route::get('unactive_tag/{tag_id}', 'App\Http\Controllers\PostTagController@unactiveTag')->name('unactivetag');
//comment
    Route::get('all_comment', 'App\Http\Controllers\PostCommentController@allComment')->name('allcomment');
    Route::get('active_comment/{comment_id}', 'App\Http\Controllers\PostCommentController@activeComment')->name('activecomment');
    Route::get('unactive_comment/{comment_id}', 'App\Http\Controllers\PostCommentController@unactiveComment')->name('unactivecomment');
    Route::get('edit_comment/{comment_id}', 'App\Http\Controllers\PostCommentController@editComment')->name('editcomment');
    Route::post('update_comment/{comment_id}', 'App\Http\Controllers\PostCommentController@updateComment')->name('updatecomment');
    Route::get('delete_comment/{comment_id}', 'App\Http\Controllers\PostCommentController@deleteComment')->name('deletecomment');
//product_comment
    Route::get('all_product_comment', 'App\Http\Controllers\ProductCommentController@allProductComment')->name('allproductcomment');
    Route::get('active_product_comment/{comment_id}', 'App\Http\Controllers\ProductCommentController@activeProductComment')->name('activeproductcomment');
    Route::get('unactive_product_comment/{comment_id}', 'App\Http\Controllers\ProductCommentController@unactiveProductComment')->name('unactiveproductcomment');
    Route::get('edit_product_comment/{comment_id}', 'App\Http\Controllers\ProductCommentController@editProductComment')->name('editproductcomment');
    Route::post('update_product_comment/{comment_id}', 'App\Http\Controllers\ProductCommentController@updateProductComment')->name('updateproductcomment');
    Route::get('delete_product_comment/{comment_id}', 'App\Http\Controllers\ProductCommentController@deleteProductComment')->name('deleteproductcomment');

});


// ---------------------->
//Customer
Route::get('home', 'App\Http\Controllers\FrontendController@viewHome')->name('viewhome');
Route::post('tim-kiem', 'App\Http\Controllers\FrontendController@search')->name('search');
Route::get('danhmucsanpham/{category_slug}', 'App\Http\Controllers\FrontendController@viewCategory')->name('viewcategory');
Route::get('thuonghieu/{brand_name}', 'App\Http\Controllers\FrontendController@viewBrands')->name('viewbrand');
Route::get('chitietsanpham/{product_id}', 'App\Http\Controllers\FrontendController@detailProduct')->name('detailproduct');
// add-cart-ajax
    Route::post('add-cart-ajax', 'App\Http\Controllers\CartController@addCartAjax')->name('addcartajax');
    Route::get('cart','App\Http\Controllers\CartController@viewCart')->name('viewcart');
    Route::get('del-cart/{session_id}','App\Http\Controllers\CartController@delCart')->name('delcart');
    Route::post('up-cart', 'App\Http\Controllers\CartController@upCart')->name('upcart');
//check-coupon
Route::post('check-coupon','App\Http\Controllers\CartController@checkCoupon')->name('checkcoupon');
//login-logout
Route::get('login-checkout', 'App\Http\Controllers\FrontendController@loginCheckout')->name('logincheckout');
Route::post('addcustomer', 'App\Http\Controllers\FrontendController@addCustomer')->name('addcustomer');
Route::post('logincustomer', 'App\Http\Controllers\FrontendController@loginCustomer')->name('logincustomer');
Route::get('logoutcustomer', 'App\Http\Controllers\FrontendController@logoutCustomer')->name('logoutcustomer');

//Check-out
Route::group(['middleware' =>['auth.User', 'auth.Verify', 'verified']], function(){
    Route::get('show-checkout', 'App\Http\Controllers\CheckoutController@showCheckout')->name('showcheckout');
    Route::post('select-delivery-home', 'App\Http\Controllers\CheckoutController@selectDeliveryHome')->name('selectdeliveryhome');
    Route::post('calculate-delivery', 'App\Http\Controllers\CheckoutController@calculateDelivery')->name('calculatedelivery');
    Route::post('confirm-order', 'App\Http\Controllers\CheckoutController@confirmOrder')->name('confirmorder');
});
//post_comment
    Route::post('send_comment', 'App\Http\Controllers\FrontendController@sendComment')->name('sendcomment');
    Route::post('load_comment','App\Http\Controllers\FrontendController@loadComment')->name('loadcomment');
    Route::post('load_product_comment','App\Http\Controllers\FrontendController@loadProductComment')->name('loadproductcomment');
    Route::post('send_product_comment', 'App\Http\Controllers\FrontendController@sendProductComment')->name('sendproductcomment');
    //rating
    Route::post('insert_rating', 'App\Http\Controllers\FrontendController@insertRating')->name('insertrating');




//Blog
    Route::get('blog/{category_post_slug}', 'App\Http\Controllers\FrontendController@viewCategoryPost')->name('viewcategorypost');
    Route::get('detail_post/{post_slug}', 'App\Http\Controllers\FrontendController@viewPost')->name('viewpost');
//social

    Route::get('admin/redirect/{provider}', 'App\Http\Controllers\SocialController@redirect')->name('redirect');
    Route::get('admin/callback/{provider}', 'App\Http\Controllers\SocialController@callback');

//
// Route::get('/email/verify', function () {
//     return view('verify-email');
// })->middleware('auth')->name('verification.notice');

// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest  $request) {
//     // $request->fulfill();
//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request) {
//     $request->user()->sendEmailVerificationNotification();

//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

    Route::get('/email/verify/{token}', 'App\Http\Controllers\FrontendController@verifyAccount')->name('user.verify');















Route::get('fake-user', function () {
    $user = new App\Models\User;
	$user->name = 'Sang';
	$user->email = 'sangty56vn@gmail.com';
	$user->password = bcrypt('123456');
	$user->save();
});




