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
                Thêm danh mục bài viết
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
                        <input type="text" name="cate_post_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug</label>
                        <input type="text" name="cate_post_slug" class="form-control" id="convert_slug" placeholder="Slug">
                    </div>
                    <div class="form-group">
                        <label >Mô tả</label>
                         <textarea class="form-control" name="cate_post_desc" placeholder="Mô tả danh mục" >
                        </textarea>
                    </div>
               
                    <button type="submit" name="add_cate_post"class="btn btn-success">Thêm danh mục bài viết</button>
                    <p><a href="{{url('admin/cate_post/all')}}"  class="btn btn-success">Back</a></p>
                </form>
            </div>
        </section>

        </div>
        </div>


        <!-- page end-->
        </div>
</section>
@endsection