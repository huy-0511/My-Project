<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Socialite;	
class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(){
    	return view('backend/index');
    }
 //    public function login_google(){
 //        return Socialite::driver('google')->redirect();
 //   }
	// public function callback_google(){
	//        try {
	//             $user = Socialite::driver('google')->user();
	//         } catch (\Exception $e) {
	//             return redirect('/login');
	//         }
	//         // only allow people with @company.com to login
	//         if(explode("@", $user->email)[1] !== 'gmail.com'){
	//             return redirect()->to('/');
	//         }
	//         // check if they're an existing user
	//         $existingUser = User::where('email', $user->email)->first();
	//         if($existingUser){
	//             // log them in
	//             auth()->login($existingUser, true);
	//         } else {
	//             // create a new user
	//             $newUser                  = new User;
	//             $newUser->name            = $user->name;
	//             $newUser->email           = $user->email;
	//             $newUser->google_id       = $user->id;
	//             $newUser->level           = 0;
	//             $newUser->password 		  = '';
	//             $newUser->phone 		  = '';
	//             $newUser->save();
	//             auth()->login($newUser, true);
	//         }
	//         return redirect()->to('admin/dashboard');
	//     }
       
    public function redirect($provider){
	     return Socialite::driver($provider)->redirect();
	}
	public function callback($provider){
			   
	   $getInfo = Socialite::driver($provider)->user();
 		return $getInfo->token;
	//    $user = $this->createUser($getInfo,$provider); 
	//    auth()->login($user); 
	//    return redirect('admin/dashboard');
	// }
	// function createUser($getInfo,$provider){
	//  $user = User::where('provider_id', $getInfo->id)->first();
	//  if ($user) {
	//  	return $user;
	//    }
	//    return  User::create([
	//          'name'     => $getInfo->name,
	//          'email'    => $getInfo->email,
	//          'provider' => $provider,
	//          'provider_id' => $getInfo->id,
	//          'level' => 0,
	//          'password' =>'',
	//          'phone' =>'',
	//      ]);
	  
	 }

   
}
