<?php

namespace App\Http\Controllers\Frontend;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Ship;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Details;
use App\Models\City;
use App\Models\Wards;
use App\Models\District;
use App\Models\Feeship;
use App\Models\CatePost;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\DB;
use Session;
class CheckoutController extends Controller
{
    public function confirm_order(Request $request){
        $data = $request->all();
        $shipping = new Ship;
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_note = $data['shipping_note'];
        $shipping->shipping_method = $data['shipping_method'];
        $shipping->save();

        $check_code = substr(md5(microtime()), rand(0,26),5);//tạo random chữ và số bất kì và lấy 5 chữ số bất kỳ để tạo mỗi đơn hàng là 1 mã riêng 
        $shipping_id = $shipping->id;
        $customer_id = Auth::user()->id; 
        $order = new Order;
        $order->customer_id = $customer_id;
        $order->shipping_id = $shipping_id;
        $order->order_code = $check_code;
        $order->order_status = 1; //1 là đơn hàng mới
        $order->save();

        $cart = Session::get('cart');
        if($cart){
            foreach ($cart as $key => $value) {
                $order_detail = new Details;
                $order_detail->order_details_code =  $check_code;
                $order_detail->product_id = $value['id'];
                $order_detail->product_name = $value['product_name'];
                $order_detail->product_price = $value['product_price'];
                $order_detail->product_fee = $data['order_fee'];
                $order_detail->product_coupon = $data['order_coupon'];
                $order_detail->product_sales_quantily = $value['product_qty']; 
                $order_detail->save();
            }
        }
        Session::forget('cart');
        Session::forget('fee');
        Session::forget('coupon');
    }
    public function calculate_fee(Request $request){
        $data = $request->all();

        if($data['matp']){
            $feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship > 0){// nếu mà chọn thành phố có trong DB thì lấy giá tiền ra
                    foreach ($feeship as $key => $value) {
                    Session::put('fee',$value['fee_feeship']);
                    Session::save();
                    }
                }else{//ngược lại ko chọn giống thì mặc định phí ship là 10k
                     Session::put('fee',10000);
                    Session::save();
                }
            }
            
        }
    }
    public function delete_fee(){
        $fee = Session::get('fee');
        if($fee == true){
            Session::forget('fee');
            return redirect('/checkout')->with('success', __('Đã xóa phi vận chuyện thành công.')); 
        }
    }
    public function select_delivery_checkout(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action'] == 'city'){
                $select_district = District::where('id_matp',$data['ma_id'])->orderby('id','ASC')->get();
                
                $output.= '<option>--Chọn quận huyện--</option>';
                foreach ($select_district as $key => $district) {
                    $output.='<option value="'.$district['id'].'">'.$district['name_quan'].'</option>';
                }
                
            }else{  
                $select_wards = Wards::where('id_maqh',$data['ma_id'])->orderby('id','ASC')->get();
                $output.= '<option>--Chọn xã phường--</option>';
                foreach ($select_wards as $key => $wards) {
                    $output.='<option value="'.$wards['id'].'">'.$wards['name_phuong'].'</option>';
                }
            }
            
        }
        echo $output;
    }
    public function show_checkout(){
        $city = City::orderby('id','ASC')->get();
        $cate_post = CatePost::orderBy('id','DESC')->get();
    	if(Auth::check()){
    		return view('frontend/checkout/checkout',compact('city','cate_post'));
    	}else{
    		return redirect('/member/login');
    	}  

    }
    // public function post_checkout(Request $request){
    // 	// $data = $request->all()

    // 	// $data = array();
    // 	// $data['shipping_name'] = $request->shipping_name;
    // 	// $data['shipping_email'] = $request->shipping_email;
    // 	// $data['shipping_phone'] = $request->shipping_phone;
    // 	// $data['shipping_address'] = $request->shipping_address;
    // 	// $data['shipping_note'] = $request->shipping_note;
    // 	$data = new Ship;
    //     $data->shipping_name = $request->shipping_name;
    //     $data->shipping_email = $request->shipping_email;
    //     $data->shipping_phone = $request->shipping_phone;
    //     $data->shipping_address = $request->shipping_address;
    //     $data->shipping_note = $request->shipping_note;
    //     $data->save();
    //     Session::put('id',$data['id']);
    //     return redirect()->back()->with('success', __('Gửi thông tin thành công.'));
    // 	// $shipping_id = DB::table('shipping')
    // 	// if(Ship::create($data)){
    // 	// 	return redirect()->back()->with('success', __('Gửi thông tin thành công.'));
    		
    // 	// }else{
   	// 	// 	return redirect()->back()->withErrors('gửi thông tin thất bại.');
   	// 	// }

    // }
    public function payment(){
    	return view('frontend/checkout/payment');
    }
    public function order_place(Request $request){
    	$cart = Session::get('cart');
    	// $id_shipping = Session::get('id');
    	$total = 0;
    	foreach ($cart as $key1 => $value1) {
    		$subtotal = $value1['product_price'] * $value1['product_qty'];
    		$total += $subtotal;
    	}
    	
    	$customer_id = Auth::user()->id;
    	$payment = new Payment;
    	$payment['payment_method'] = $request->payment_option;
    	$payment['payment_status'] = 'Đang chờ xử lý';
    	$payment->save();

    	$order_data = new Order;
    	$order_data['customer_id'] = $customer_id;
    	$order_data['shipping_id'] = Session::get('id');
    	$order_data['payment_id'] = $payment['id'];
    	$order_data['order_total'] = $total;
    	$order_data['order_status'] = 'Đang xử lý'; 
    	$order_data->save();

    	foreach ($cart as $key => $value) {
    		$order_detail_data = new Details;
	    	$order_detail_data['order_id'] = $order_data['id'];
	    	$order_detail_data['product_id'] = $value['id'];
	    	$order_detail_data['product_name'] = $value['product_name'];
	    	$order_detail_data['product_price'] = $value['product_price'];
	    	$order_detail_data['product_sales_quantily'] = $value['product_qty']; 
	    	$order_detail_data->save();
    	}
    	if ($payment['payment_method'] == 1) {
    		echo "Thanh toán bằng thẻ ATM";
    	}else{
    		if ($payment['payment_method'] == 2){
    			Session::flush('cart');
    			return view('frontend/checkout/handcash');
    		}   		
    	}
    	return redirect('/payment')->with('success', __('Đã thanh toán xong.'));
    }
}
