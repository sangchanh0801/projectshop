<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{

    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }
    public function callback($provider){
        try {
            $getInfo = Socialite::driver($provider)->user();
            $user = $this->createUser($getInfo,$provider);
            // dd($getInfo);
            Auth::login($user);
            return redirect()->to('/home');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    function createUser($getInfo,$provider){
    $user = User::where('provider_id', $getInfo->id)->first();
    if (!$user) {
        $user = User::create([
            'name'     => $getInfo->name,
            'email'    => $getInfo->email,
            'provider' => $provider,
            'provider_id' => $getInfo->id,
        ]);
         $user->roles()->sync('4');
    }
    return $user;
    }
    // try {
    //     $user = Socialite::driver('facebook')->user();
    //     $finduser = User::where('social_id', $user->id)->first();
    //     if($finduser){
    //         Auth::login($finduser);
    //         return redirect('/home');

    //     }else{
    //         $newUser = User::create([
    //             'name' => $user->name,
    //             'email' => $user->email,
    //             'social_id'=> $user->id,
    //             'social_type'=> 'facebook',
    //             'password' => encrypt('my-facebook')
    //         ]);
    //         Auth::login($newUser);
    //         return redirect('/home');
    //     }

}
