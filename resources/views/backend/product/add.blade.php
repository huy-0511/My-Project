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
                Thêm sản phẩm
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
              <form role="form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên sản phẩm</label>
                        <input type="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Giá sản phẩm</label>
                        <input type="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="giá">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                        <input type="text" name="product_qty" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số lượng đã bán</label>
                        <input type="text" name="product_sold" class="form-control" id="exampleInputEmail1" placeholder="Số lượng sản phẩm đã bán">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                        <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" >
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                        <textarea class="form-control" id="editor" name="product_desc" placeholder="Mô tả sản phẩm">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                        <textarea class="form-control" id="editor1" name="product_content" placeholder="Mô tả nội dung sản phẩm">
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tags sản phẩm</label>
                        <input type="text" data-role="tagsinput" name="product_tags" class="form-control" >
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Danh mục</label> 
                        <select name="category_id" class="form-control input-lg m-bot15">
                          @foreach($category as $value) 
                            <option value="{{$value['id']}}">{{$value['category_name']}}</option>
                            
                          @endforeach  
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Thương hiệu</label> 
                        <select name="brand_id" class="form-control input-lg m-bot15">
                          @foreach($brand as $value)
                              <option value="{{$value['id']}}">{{$value['brand_name']}}</option>
                          @endforeach
                            
                        </select>
                    </div>
                        <button type="submit" class="btn btn-success">Thêm Sản phẩm</button>
                    <p><a href="{{url('admin/product/all')}}"  class="btn btn-success">Back</a></p>
            </form>                
            </div>
        </section>

        </div>
        </div>


        <!-- page end-->
        </div>
</section>
@endsection