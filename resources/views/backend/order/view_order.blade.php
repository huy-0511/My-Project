@extends('backend.master')
@section('content')
<section id="main-content">
	<section class="wrapper">
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin khách hàng
    </div>
   
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Tên người đặt</th>
            <th>Số điện thoại</th>
            <th>Email</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        @if($errors->any())
              <div class="alert alert-danger">
                  <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
              </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check" ></i> Thông báo!</h4>
                {{session('success')}}
            </div>
        @endif
        <tbody>

        

          <tr>
           
            <td>
             
         	
               
         		    {{$cusotmer['name']}} 
            </td>
            <td>
            	
                {{$cusotmer['phone']}}
            </td>
            <td>
              {{$cusotmer['email']}}
            </td>
          </tr>

        </tbody>
       
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm"></small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
         
           
      </div>
    </footer>
  </div>
</div>
<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin vận chuyển hàng
    </div>
   
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Tên người vận chuyển</th>
            <th>Địa chỉ</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Ghi chú</th>
            <th>Hình thức thanh toán</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        @if($errors->any())
              <div class="alert alert-danger">
                  <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
              </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check" ></i> Thông báo!</h4>
                {{session('success')}}
            </div>
        @endif
       
        <tbody>
      
          <tr>
            
            <td>
            
              {{$shipping['shipping_name']}}
            </td>
            <td>
            	
              {{$shipping['shipping_address']}}
            </td>
            <td>
            	
              {{$shipping['shipping_phone']}}
            </td>
            <td>
              {{$shipping['shipping_email']}}
            </td>
            <td>
              {{$shipping['shipping_note']}}
            </td>
            <td>
              @if($shipping['shipping_method'] == 0)
                Chuyển khoản
              @else
                tiền mặt  
              @endif
            </td> 
          </tr>
        
        </tbody>
        
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm"></small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
         
           
      </div>
    </footer>
  </div>
</div>
<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê chi tiết đơn hàng
    </div>
  
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <i>STT</i>
              </label>
            </th>
            <th>Tên sản phẩm</th>
            <th>Số lượng kho</th>
            <th>Mã giảm giá</th>
            <th>Phí ship</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng tiền</th>

            <th style="width:30px;"></th>
          </tr>
        </thead>
        @if($errors->any())
              <div class="alert alert-danger">
                  <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
              </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check" ></i> Thông báo!</h4>
                {{session('success')}}
            </div>
        @endif
       
        <tbody>
          <?php 
              $i = 0; 
              $Totall = 0;  
          ?>
         @foreach($order as $value)
          @foreach($order_detail as $value1)
            
          <?php 
            $i++;
            $subtotal = $value1['product_price'] * $value1['product_sales_quantily'];
            $Totall += $subtotal;

           ?>
          <tr class="color_qty_{{$value1['product_id']}}">
            <td><label class="i-checks m-b-none"><i>{{$i}}</i></label></td>
            <td>
              @if($value1['order_details_code'] == $value['order_code'])
                {{$value1['product_name']}}
              @endif
            </td>
            <td>
            @foreach($product as $value2)
              @if($value2['id'] == $value1['product_id'])
                {{$value2['product_qty']}}
              @endif
            @endforeach
            </td>
            <td>
              @if($value1['product_coupon'] != 'không có mã giảm giá')
                {{$value1['product_coupon']}}
              @else
                không có mã
              @endif
            </td>
            <td>
              @if($value1['order_details_code'] == $value['order_code'])
                <?php echo number_format($value1['product_fee']); ?>
              @endif
            </td>
            <td>
              @if($value1['order_details_code'] == $value['order_code'])
                <input type="number" min="1" {{$order_status == 2 ? 'disabled' : ''}} class="order_qty_{{$value1['product_id']}}" value="{{$value1['product_sales_quantily']}}" name="product_sales_quantily">
                @foreach($product as $value2) 
                   @if($value2['id'] == $value1['product_id'])           
                <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$value1['product_id']}}" value="{{$value2['product_qty']}}">
                  @endif
                @endforeach
                <input type="hidden" name="order_product_id" class="order_product_id" value="{{$value1['product_id']}}">

                <input type="hidden" name="order_code" class="order_code" value="{{$value1['order_details_code']}}">

                @if($order_status != 2)
                  <button class="btn btn-default update_quanlity" data-product_id="{{$value1['product_id']}}" name="update_quanlity">Cập nhật</button>
                @endif
              @endif

            </td>
            <td>
              @if($value1['order_details_code'] == $value['order_code'])
                <?php echo number_format($value1['product_price']); ?>
              @endif
            </td>
            
          
            
              <td>
                <?php $total = $value1['product_price'] * $value1['product_sales_quantily'];
                    echo number_format($total);
                  ?>
              </td>
                
              @endforeach 
         </tr>    
         @endforeach 
         <tr>
           <td colspan="3">
           
            
             @if($coupon_condition == 1)
                <?php 
                    foreach ($order_detail as $key => $value2) {
                        $fee_ship = $value2['product_fee'];
                    }
                    $total_after_coupon = ($Totall * $coupon_number)/100;
                    echo "Giảm khuyến mãi :".number_format($total_after_coupon)."<br>";
                    echo "Phí ship :".number_format($fee_ship)."<br>";
                    $total_coupon = $Totall - $total_after_coupon - $fee_ship;
                    echo "Thanh toán :".number_format($total_coupon);
                 ?>
              @else
                <?php
                 foreach ($order_detail as $key => $value3) {
                        $fee_ship = $value3['product_fee'];
                    }
                  echo "Giảm khuyến mãi :".number_format($coupon_number)."<br>";
                  echo "Phí ship :".number_format($fee_ship)."<br>"; 
                    $total_coupon = $Totall - $coupon_number - $fee_ship;
                    echo "Thanh toán :".number_format($total_coupon);
                 ?>
              @endif
           </td>
         </tr>
         <tr>
            <td colspan="6">
             @foreach($order as $or)
              @if($or['order_status'] == 1) 
                <form>
                    @csrf
                  <select class="form-control order_details">
                     <option value="">---Chọn hình thức đơn hàng---</option>
                     <option id="{{$or['id']}}" selected value="1">Chưa xử lý</option>  
                     <option id="{{$or['id']}}" value="2">Đã xử lý - Đã giao hàng</option>
                     <option id="{{$or['id']}}" value="3">Hủy đơn hàng - Tạm giữ</option>
                  </select>
                </form>
              @elseif($or['order_status'] == 2)
                <form>
                  @csrf
                  <select class="form-control order_details">
                    <option value="">---Chọn hình thức đơn hàng---</option>
                     <option id="{{$or['id']}}" value="1">Chưa xử lý</option>     
                     <option id="{{$or['id']}}" selected value="2">Đã xử lý - Đã giao hàng</option>
                     <option id="{{$or['id']}}" value="3">Hủy đơn hàng - Tạm giữ</option>
                  </select>
                </form>
              @else
                 <form>
                  @csrf
                  <select class="form-control order_details">
                    <option value="">---Chọn hình thức đơn hàng---</option>
                     <option id="{{$or['id']}}" value="1">Chưa xử lý</option>     
                     <option id="{{$or['id']}}" value="2">Đã xử lý - Đã giao hàng</option>
                     <option id="{{$or['id']}}" selected value="3">Hủy đơn hàng - Tạm giữ</option>
                  </select>
                </form>
              @endif 
             @endforeach 
            </td>
         </tr>
        </tbody>
        
      </table>
      <?php 
        foreach ($order_detail as $key => $value4) {
              $check_code = $value4['order_details_code'];
          }
       ?>
      <a href="{{url('admin/print-order/'.$check_code)}}">In đơn hàng</a>
    </div>
  
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.update_quanlity').click(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_'+order_product_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();
       $.ajax({
            url: "{{url('admin/update-qty')}}",
            method: "POST",
            data: {order_qty:order_qty,order_code:order_code,order_product_id:order_product_id,_token:_token},
            success: function (data) {
                alert("cập nhật thành công");
                location.reload();

            },
            error: function() {
               console.log(t);
            }
        });
    });
  });
</script>
<script type="text/javascript">
    $(document).ready(function(){
      $('.order_details').change(function(){
          var order_status = $(this).val();
          var order_id = $(this).children(":selected").attr("id");
          var _token = $('input[name="_token"]').val();
          
          //lấy ra số lượng
          quantily = [];//là 1 chuỗi
          $("input[name='product_sales_quantily']").each(function(){
             quantily.push($(this).val());
          });
          //lấy ra product_id
          order_product_id = [];//là 1 chuỗi
          $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
          });
          j = 0;
          for (i = 0; i < order_product_id.length; i++) {
            //số lượng khách đặt
              var order_QTY = $('.order_qty_' + order_product_id[i]).val();
            //số lượng tồn kho
              var order_storage = $('.order_qty_storage_' + order_product_id[i]).val();
              if (parseInt(order_QTY) > parseInt(order_storage)){
                  
                  j = j + 1;
                  if (j == 1){
                      alert('Số lượng trong kho không đủ');
                  }
                  $('.color_qty_'+order_product_id[i]).css('background','#000');
              }
          }
          if(j ==0 ){
              $.ajax({
                  url: "{{url('admin/update-order-qty')}}",
                  method: "POST",
                  data: {order_status:order_status,order_id:order_id,quantily:quantily,order_product_id:order_product_id,_token:_token},
                  success: function (data) {
                      alert("Thay đổi tình trạng đơn hàng thành công");
                      location.reload();

                  },
                  error: function() {
                     console.log(t);
                  }
              });
          }
           
      });
    });

</script>
@endsection