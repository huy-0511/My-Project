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
                Chỉnh Sửa Danh mục
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
                        <label for="exampleInputEmail1">Tên danh mục</label>
                        <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục" value="{{$data_edit['category_name']}}">
                    </div>
                    <div class="form-group">
                        <label >Mô tả</label>
                         <textarea class="form-control" name="category_desc" placeholder="Mô tả danh mục" >
                            {{$data_edit['category_desc']}}
                        </textarea>
                    </div>
               
                    <button type="submit" class="btn btn-success">Update</button>
                    <p><a href="{{url('admin/category/all')}}"  class="btn btn-success">Back</a></p>
                </form>
                
            </div>
        </section>

        </div>
        </div>


        <!-- page end-->
        </div>
</section>
@endsection