<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\CatePost;
use App\User;
class LoginController extends Controller
{
    public function getLogin(){
        $cate_post = CatePost::orderBy('id','DESC')->get(); 
    	return view('frontend/login/login',compact('cate_post'));
    }
    public function postLogin(Request $request){
    	// $email = $request->customer_email;
    	// $password = $request->customer_password;
    	// $data = $request->all();
    	// dd($data);
    	// $customer = Customer::where('customer_email',$email)->get();
    	
    	// foreach ($customer as $key => $value) {
    		
    	// }
    	// if($value['customer_password'] == $password){
	    // 		echo "thành công";
	    // 	}else{
	    // 		echo "không thành công";
	    // 	}
    	$login = [
    		'email' => $request->email,
    		'password' => $request->password,
    		'level'=> 1,
    	];
    	if (Auth::attempt($login)) {
    		return redirect('/index');
    	}else{
    		return redirect('/member/login');
    	}

    }
    public function getRegister(){
        $cate_post = CatePost::orderBy('id','DESC')->get();
    	return view('frontend/login/register',compact('cate_post'));
    }
    public function postRegister(Request $request){
    	$data = $request->all();
    	$data['password'] = bcrypt($data['password']);
    	$data['level'] = 1;
    	if(User::create($data)){
    		  return redirect()->back()->with('success', __('Đăng kí tài khoản thành công.'));
        } else {
            return redirect()->back()->withErrors('Đăng kí bị lỗi.');
    	}
    }
    public function getlogout()
    {
        Auth::logout();
        return redirect('/member/login');
    }
}
