@extends('backend.master')
@section('content')
<section id="main-content">
    <section class="wrapper">
    <div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
        <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Mã giảm giá
            </header>
            <div class="panel-body">
                <div class="position-center">
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
                <form role="form" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên mã giảm giá</label>
                        <input type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                    </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Mã giảm giá</label>
                        <input type="text" name="coupon_code" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                    </div>
                      <div class="form-group">
                        <label for="exampleInputEmail1">Số lượng mã</label>
                        <input type="text" name="coupon_time" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tính năng mã</label>
                        <select name="coupon_condition" class="form-control input-sm m-bot15">
                        	<option value="">Select</option>
                        	<option value="1">Giảm theo phần trăm</option>
                        	<option value="2">Giảm theo tiền</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nhập số % hoặc tiền giảm</label>
                        <input type="text" name="coupon_number" class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                    </div>
               
                    <button type="submit" class="btn btn-success">Thêm giảm giá</button>
                    <p><a href="{{url('admin/coupon/all')}}"  class="btn btn-success">Back</a></p>
                </form>
            </div>
        </section>

        </div>
        </div>


        <!-- page end-->
        </div>
</section>
@endsection