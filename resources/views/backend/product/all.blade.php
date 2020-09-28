@extends('backend.master')
@section('content')
<section id="main-content">
	<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Danh sách sản phẩm
    </div>
  <!--   <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div> -->
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
           
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng Sản phẩm</th>
            <th>Số lượng đã bán</th>
            <th>Hình ảnh</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>

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
          @foreach($product as $value)
          <tr>
            <td>{{$value['product_name']}}</td>
            <td>{{$value['product_price']}}</td>
            <td>{{$value['product_qty']}}</td>
            <td>{{$value['product_sold']}}</td>
            <td><img src="{{asset('product/'.$value['product_image'])}}" height="80" width="80"></td>
            <td>
              @foreach($category as $value1)
                @if($value1['id'] == $value['category_id'])
                  {{$value1['category_name']}}
                 @endif 
              @endforeach
            </td>
            <td>
              @foreach($brand as $value2)
                @if($value2['id'] == $value['brand_id'])
                  {{$value2['brand_name']}}
                @endif 
              @endforeach
            </td>

             <td>
              <a href="{{url('admin/product/edit/'.$value['id'])}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')" href="{{url('admin/product/delete/'.$value['id'])}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>

         @endforeach
        </tbody>
        
      </table>
      <p><a href="{{url('admin/product/add')}}" class="btn btn-success" style="float: right;">Add</a></p>
    </div>
   <!--  <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">Hiện tại có {{$count_product}} sản phẩm trong danh sách</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
         
           
        </div>
      </div>
    </footer> -->
  </div>
</div>
@endsection