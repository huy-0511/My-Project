<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
class LoginController extends Controller
{
    public function getLogin(){
    	return view('backend/login/login');
    }
    public function postLogin(Request $request){
    	$login = [
    		'email' => $request->email,
    		'password' => $request->password,
    		'level'=> 0
    	];
    	if (Auth::attempt($login)) {
    		return redirect('admin/dashboard');
    	}else{
    		return redirect('admin/login');
    	}
    }

    public function getRegister(){
    	return view('backend/login/register');
    }
    public function postRegister(Request $request){
    	$data = $request->all();
    	$data['password'] = bcrypt($data['password']);
    	$data['level'] = 0;
    	if(User::create($data)){
    		  return redirect()->back()->with('success', __('Đăng kí tài khoản thành công.'));
        } else {
            return redirect()->back()->withErrors('Đăng kí bị lỗi.');
    	}
    }

    public function getlogout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
