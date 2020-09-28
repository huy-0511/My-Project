<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\CatePost;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Cart;
Session_start();
class CartController extends Controller
{
    public function Details_product($product_id){
        $cate_post = CatePost::orderBy('id','DESC')->get(); 
        $category = Category::all();
        $brand = Brand::all();
        $all_product = Product::all();
        $product_detail = Product::where('id',$product_id)->get(); 
        return view('frontend/sanpham/show_details',compact('category','brand','product_detail','all_product','cate_post'));
    }
    public function getCart(){
      $cate_post = CatePost::orderBy('id','DESC')->get(); 
    	return view('frontend/cart/show_cart',compact('cate_post'));
    }
    public function check_coupon(Request $request){
      $data = $request->all();
      $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
      if($coupon){
        $cout_coupon = $coupon->count();
        if ($cout_coupon > 0) {
            $session_coupon = Session::get('coupon');
          if ($session_coupon == true){
             $is_avaiable = 0;
             if($is_avaiable == 0){
                $cou[] = array(
                   'coupon_code'=>$coupon->coupon_code,
                   'coupon_condition'=>$coupon->coupon_condition,
                   'coupon_number'=>$coupon->coupon_number,
                );
                Session::put('coupon',$cou);
             }
          }else{
                $cou[] = array(
                   'coupon_code'=>$coupon->coupon_code,
                   'coupon_condition'=>$coupon->coupon_condition,
                   'coupon_number'=>$coupon->coupon_number,
                );
                Session::put('coupon',$cou);
             }
          Session::save();
          return redirect()->back()->with('success', __('Thêm mã khuyến mãi thành công.'));
        }
      }else{
        return redirect()->back()->withErrors('Thêm mã khuyến mãi không thành công');
      }
    }
    public function delete_coupon(){
        $coupon = Session::get('coupon');
        if($coupon == true){
             Session::forget('coupon');
            return redirect()->back()->with('success', __('xóa mã khuyến mãi hàng thành công.'));
        }
    }
    // public function AddCart(Request $request, $id){
    	
    // 	$product = Product::where('id',$id)->first();
    // 	if ($product != null) {
    // 		if (Session('Cart') != null) {
    // 			$oldCart = Session('Cart');
    // 		}else{
    // 			$oldCart = null;
    // 		}
    // 		$newCart = new Cart($oldCart);
    // 		$newCart->AddCart($product, $id);
    // 		$request->session()->put('Cart', $newCart);

    // 	}
    // 	return view('/index',compact('newCart'));
    // }
    public function add_cart_ajax(Request $request){
    	$data = $request->all();
    	// print_r($data);
    	$session_id = substr(md5(microtime()), rand(0,26),5);
    	$cart = Session::get('cart');
    	if ($cart == true){
    		$is_avaiable = 0;	
    		foreach($cart as $key => $value) {
    			if ($value['id'] == $data['cart_product_id']){
    				$is_avaiable ++;
    			}
    		}
    	// nếu trùng sp thì trong giỏ hàng ko có sp trùng và tạo ra 1sp mới
    		if ($is_avaiable == 0){
    			$cart[] = array(
    			'session_id' => $session_id,
    			'product_name'=> $data['cart_product_name'],
    			'id'=> $data['cart_product_id'],
    			'product_image'=> $data['cart_product_image'],
          'product_quantity'=> $data['cart_product_quantity'],
    			'product_qty'=> $data['cart_product_qty'],
    			'product_price'=> $data['cart_product_price'],	
    			);
    			Session::put('cart',$cart);
    		}
    	}else{
    		$cart[] = array(
    			'session_id' => $session_id,
    			'product_name'=> $data['cart_product_name'],
    			'id'=> $data['cart_product_id'],
    			'product_image'=> $data['cart_product_image'],
          'product_quantity'=> $data['cart_product_quantity'],
    			'product_qty'=> $data['cart_product_qty'],
    			'product_price'=> $data['cart_product_price'],	
    		);
    	}
    	Session::put('cart',$cart);
    	Session::save();
   }
   public function delete_product($session_id){
   		$cart = Session::get('cart');
   		if($cart == true){
   			foreach ($cart as $key => $value) {
   				if($value['session_id'] == $session_id){
   					unset($cart[$key]);
   				}
   			}
   			Session::put('cart',$cart);
   			 return redirect()->back()->with('success', __('xóa sản phẩm thành công.'));
   		}else{
   			return redirect()->back()->withErrors('xóa sản phẩm thất bại.');
   		}
   }
   public function updateCart(Request $request){
   		$data = $request->all();
   		$cart = Session::get('cart');
   		if($cart == true){
        
   			foreach ($data['qty'] as $key => $value) {

   				foreach ($cart as $key1 => $value1) {

   					if ($value1['session_id'] == $key && $value < $cart[$key1]['product_quantity']){
   						$cart[$key1]['product_qty'] = $value;
                         
   					}elseif($value1['session_id'] == $key && $value > $cart[$key1]['product_quantity']){

            }
   				}
   			}
   			Session::put('cart',$cart);
   			return redirect()->back()->with('success', __('cập nhật số lượng thành công.'));
   		}else{
   			return redirect()->back()->withErrors('cập nhật số lượng thất bại.');
   		}
   }
   public function delete_all_product(){
   		$cart = Session::get('cart');
   		if($cart == true){
   			Session::forget('cart');
        Session::forget('coupon');
   			return redirect()->back()->with('success', __('xóa hết giỏ hàng thành công.'));
   		}
   }
}
