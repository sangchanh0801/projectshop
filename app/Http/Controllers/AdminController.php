<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckLogin;
use App\Http\Requests\SettingRequest;
use App\Models\brand_product;
use App\Models\category_product;
use App\Models\post;
use App\Models\product;
use App\Models\profile;
use App\Models\settings;
use App\Models\Statistic;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\CssSelector\XPath\Extension\FunctionExtension;

class AdminController extends Controller
{
    public function showdashboard(){
        $count_product = product::all()->count();
        $count_post= post::all()->count();
        $count_brand = brand_product::all()->count();
        $count_cate_product = category_product::all()->count();
        return view('admin.dashboard', compact('count_product', 'count_post','count_brand','count_cate_product'));
    }
//Login
    public function showLogin()
    {
      return view('admin.login');
    }
    public function checkLogin(CheckLogin $request){
        $data = $request->only('email', 'password');
        $validator = Validator::make($data, [
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);
        $token = JWTAuth::attempt($data);
        echo $token;
        // if (Auth::attempt(['email' => $email, 'password' => $password])) {
        //     $token = auth()->attempt(['email' => $email, 'password' => $password]);
        //     $user = User::where('email' ,$email)->first();
        //     Auth::login($user);
        //     echo $token;
        //     // return redirect()->route('showcheckout');
        // }else
        //     return redirect()->back()->with('message' ,'Tài khoản hoặc mật khẩu không đúng');

    }
//Logout
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

//Setting
    public function settings(){
        $edit_setting=settings::first();
        return view('admin.setting', compact('edit_setting'));
    }

    public function updateSetting(SettingRequest $request){
        $data=$request->all();
        $edit_setting=Settings::first();
        $edit_setting->setting_email = $data['setting_email'];
        $edit_setting->setting_address = $data['setting_address'];
        $edit_setting->setting_phone = $data['setting_phone'];
        $edit_setting->setting_logo = $data['setting_logo'];
        $edit_setting->save();
        if($edit_setting){
           return redirect()->back()->with('mess', 'Cập nhật thành công');
        }
        else{
            return redirect()->back()->with('mess', 'Cập nhật thất bại');
        }


    }
//PROFILE
    public function profile(){
        $profile=Auth()->user();
        return view('profile', compact('profile'));
    }
    public function updateProfile(Request $request,$id){
        $data = $request->all();
        $edit_profile =User::findOrFail($id);
        $edit_profile->name = $data['name'];
        $edit_profile->phone = $data['phone'];
        $edit_profile->address = $data['address'];
        $edit_profile->avatar = $data['avatar'];
        $edit_profile->birthday = $data['birthday'];
        $edit_profile->gender = $data['gender'];
        $edit_profile->save();
        return redirect()->back()->with('mess', 'Cập nhật thành công');

    }
    public function filterByDay(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $end_date = $data['end_date'];
        $get = Statistic::whereBetween('order_date', [$from_date, $end_date])->orderBy('order_date', 'ASC')->get();
        foreach($get as $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sale' => $val->sales,
                'profit' => $val->profit,
                'quantity' =>$val->quantity,
            );
        }
        echo $data = json_encode($chart_data);

    }
    public function dashboard_filter(Request $request){
        $data = $request->all();
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $sub7ngay = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365ngay = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = array();
        $chart_data = array();
        if ($data['dashboard_value'] == '7ngay') {
            $get = Statistic::whereBetween('order_date', [$sub7ngay, $now])->orderBy('order_date', 'ASC')->get();
        }elseif($data['dashboard_value'] == 'Thangnay'){
            $get = Statistic::whereBetween('order_date', [$dauthangnay, $now])->orderBy('order_date', 'ASC')->get();
        }elseif($data['dashboard_value'] == 'Thangtruoc'){
            $get = Statistic::whereBetween('order_date', [$dauthangtruoc, $cuoithangtruoc])->orderBy('order_date', 'ASC')->get();
        }elseif($data['dashboard_value'] == '365ngay'){
            $get = Statistic::whereBetween('order_date', [$sub365ngay, $now])->orderBy('order_date', 'ASC')->get();
        }
        foreach($get as $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sale' => $val->sales,
                'profit' => $val->profit,
                'quantity' =>$val->quantity,
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function day_filter(Request $request){
        $data = $request->all();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $sub30ngay = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
        $get = Statistic::whereBetween('order_date', [$sub30ngay, $now])->orderBy('order_date', 'ASC')->get();
        $chart_data = array();
        foreach($get as $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sale' => $val->sales,
                'profit' => $val->profit,
                'quantity' =>$val->quantity,
            );
        }
        echo $data = json_encode($chart_data);
    }




}
