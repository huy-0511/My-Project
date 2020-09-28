<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Ship;
use App\Models\Details;
use App\Models\Coupon;
use App\User;
use PDF;
class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function update_qty(Request $request){
        $data = $request->all();
        $order_detail_update_qty = Details::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
        $order_detail_update_qty['product_sales_quantily'] = $data['order_qty'];
        $order_detail_update_qty->save();
    }
    public function update_order_qty(Request $request){
        //update-order
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order['order_status'] = $data['order_status'];
        $order->save(); 
        if($order['order_status'] == 2){
            foreach ($data['order_product_id'] as $key => $id) {
                $product = Product::find($id);
                $product_quantily = $product->product_qty;
                $product_sold = $product->product_sold;
              foreach ($data['quantily'] as $key1 => $value1) {
                    if($key == $key1){
                        $product_remain = $product_quantily - $value1;
                        $product->product_qty = $product_remain;
                        $product->product_sold = $product_sold + $value1;
                        $product->save();
                    }
                }  
            }
        }elseif($order['order_status'] != 2 && $order['order_status'] != 3) {
            foreach ($data['order_product_id'] as $key => $id) {
                $product = Product::find($id);
                $product_quantily = $product->product_qty;
                $product_sold = $product->product_sold;
              foreach ($data['quantily'] as $key1 => $value1) {
                    if($key == $key1){
                        $product_remain = $product_quantily + $value1; // số lượng còn
                        $product->product_qty = $product_remain;
                        $product->product_sold = $product_sold - $value1;
                        $product->save();
                    }
                }  
            }
        }   
    }
    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        $order = Order::where('order_code',$checkout_code)->get();
        $order_detail = Details::where('order_details_code',$checkout_code)->get();
        foreach ($order as $key => $value) {
            $customer_id = $value['customer_id'];
            $shipping_id = $value['shipping_id'];
        }
        $customer = User::where('id', $customer_id)->first();
        $shipping = Ship::where('id',$shipping_id)->first();

        $order_detail_product = Details::with('Product')->where('order_details_code',$checkout_code)->get();

        foreach ($order_detail as $key => $detail) {
             $product_coupon = $detail['product_coupon'];   
        }
        if($product_coupon != 'không có mã giảm giá'){
             $coupon = Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
            if($coupon_condition == 1){
                $coupon_echo = $coupon_number.'%';
            }elseif($coupon_condition == 2){
                 $coupon_echo = number_format($coupon_number).'đ';
            }
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
            $coupon_echo = '0';
        }    
        $output = '';
        $output.='
            <style>
            body{
                font-family: DejaVu Sans;
            }
            .table-styling{
                border:1px solid #000;
            }
            .table-styling tbody tr td{
                border:1px solid #000;
            }
            </style>
            <h1><center>Công ty TNHH Dinh Huy</center></h1>
            <h4><center>Cộng Hòa Xã Hội Chủ Nghĩa Việt Nam</center></h4> 
            <h4><center>Độc lập - Tự do - Hạnh phúc</center></h4>
            <p>Người đặt hàng</p>
                <table class="table-styling">
                     <thead>
                        <tr>
                            <th>Tên khách đặt</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                        </tr>
                     </thead>
                     <tbody>';                     
                $output.='
                        <tr>
                            <td>'.$customer['name'].'</td>
                            <td>'.$customer['phone'].'</td>
                            <td>'.$customer['email'].'</td>
                        </tr>';
                $output.='
                     </tbody>
                </table>

            <p>Ship hàng tới</p>
                <table class="table-styling">
                     <thead>
                        <tr>
                            <th>Tên người nhận</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Ghi chú</th>
                        </tr>
                     </thead>
                     <tbody>';                     
                $output.='
                        <tr>
                            <td>'.$shipping['shipping_name'].'</td>
                            <td>'.$shipping['shipping_address'].'</td>
                            <td>'.$shipping['shipping_phone'].'</td>
                            <td>'.$shipping['shipping_email'].'</td>
                            <td>'.$shipping['shipping_note'].'</td>
                        </tr>';
                $output.='
                     </tbody>
                </table>    

            <p>Đơn hàng đặt</p>
                <table class="table-styling">
                     <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Mã giảm giá</th>
                            <th>Phí ship</th>
                            <th>Số lượng</th>
                            <th>Giá sản phẩm</th>
                            <th>Thành tiền</th>
                        </tr>
                     </thead>
                     <tbody>';
                    
                     $total = 0;

                     foreach ($order_detail_product as $key => $pro) {                                      
                        $subtotal  = $pro->product_price * $pro->product_sales_quantily;
                        $total += $subtotal;  
                        $feeship = $total - $pro->product_fee;

                    if ($pro->product_coupon != 'không có mã giảm giá') {
                           $product_coupon = $pro->product_coupon;
                    }else{
                            $product_coupon = 'không có mã giảm giá'; 
                    }        
                $output.='
                        <tr>
                            <td>'.$pro['product_name'].'</td>
                            <td>'.$product_coupon.'</td>
                            <td>'.number_format($pro['product_fee']).'đ'.'</td>
                            <td>'.$pro['product_sales_quantily'].'</td>
                            <td>'.number_format($pro['product_price']).'đ'.'</td>
                            <td>'.number_format($subtotal).'đ'.'</td>
                        </tr>';
                    }
                     if ($coupon_condition == 1) {
                          
                            $total_after_coupon = ($total * $coupon_number)/100;
                            $total_coupon = $total - $total_after_coupon;
                     }else{
                          
                            $total_coupon = $total - $coupon_number;
                           
                     }
                $output.='<tr>
                              <td colspan="2">
                                    <p>Tổng Mã giảm giá :'. $coupon_echo.'</p>
                                    <p>Phí ship :'.number_format($pro['product_fee']).'đ'.'</p>
                                    <p>Thanh toán :'.number_format($total_coupon - $pro['product_fee']).'đ'.'</p>
                              </td>
                          </tr>';    
                $output.='
                     </tbody>
                </table>

                <p>Ký tên</p>
                <table >
                     <thead>
                        <tr>
                            <th width="200px">Người lập phiếu</th>
                            <th width="800px">Người nhận</th>
                            
                        </tr>
                     </thead>
                     <tbody>';                     
               
                $output.='
                     </tbody>
                </table>    

                ';
        return $output;
    }
    public function ordertAll(){
        $order = Order::orderby('id','DESC')->get();
    	return view('backend/order/manager_order',compact('order'));
    }
    public function view_order($order_code){
    	// $id = Order::findOrFail($id);
        $order = Order::where('order_code',$order_code)->get();
        $order_detail = Details::where('order_details_code',$order_code)->get();
        foreach ($order as $key => $value) {
            $customer_id = $value['customer_id'];
            $shipping_id = $value['shipping_id'];
            $order_status = $value['order_status'];
        }
        $cusotmer = User::where('id', $customer_id)->first();
        $shipping = Ship::where('id',$shipping_id)->first();
        foreach ($order_detail as $key => $detail) {
             $product_coupon = $detail['product_coupon'];
             $product_id = $detail['product_id'];
        }
        if($product_coupon != 'không có mã giảm giá'){
             $coupon = Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
        }
        $product = Product::all();    
        // $order_detail_Product = Details::with('Product')->where('order_details_code',$order_code)->get();
    	return view('backend/order/view_order',compact('order_detail','cusotmer','shipping','order','coupon_condition','coupon_number','product','order_status'));
    }
}
