<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
class MailController extends Controller
{
    public function send_mail(){
    	$to_name = "Dinh Huy";
        $to_email = "phamnguyendinhhuy.dn@gmail.com";//send to this email

        $data = array("name"=>"Mail từ tài khoản khách hàng","body"=>'Mail gửi về vấn đề hàng hóa'); //body of mail.blade.php
    
        Mail::send('frontend.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('test gửi mail google');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
        });
        return redirect('/')->with('message','');
    }
}
