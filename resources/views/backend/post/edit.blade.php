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
                Chỉnh sửa bài viết
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
                <form role="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tên bài viết</label>
                        <input type="text" name="post_title" class="form-control" onkeyup="ChangeToSlug();" id="slug" placeholder="Tên danh mục" value="{{$getPost['post_title']}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Slug</label>
                        <input type="text" name="post_slug" class="form-control" id="convert_slug" placeholder="Slug" value="{{$getPost['post_slug']}}">
                    </div>
                    <div class="form-group">
                        <label >Tóm tắt bài viết</label>
                         <textarea class="form-control" name="post_desc" id="editor2" placeholder="Mô tả danh mục" >{{$getPost['post_desc']}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label >Nội dung bài viết</label>
                         <textarea class="form-control" name="post_content" id="editor3" placeholder="Mô tả danh mục" >{{$getPost['post_content']}}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Meta từ khóa</label>
                         <textarea class="form-control" name="post_meta_keywords" placeholder="Mô tả danh mục" >{{$getPost['post_meta_keywords']}}
                        </textarea>
                    </div>
                     <div class="form-group">
                        <label>Meta nội dung</label>
                         <textarea class="form-control" name="post_meta_desc" placeholder="Mô tả danh mục" >{{$getPost['post_meta_desc']}}
                        </textarea>
                    </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Hình ảnh bài viết</label>
                        <input type="file" name="post_image" class="form-control" id="exampleInputEmail1" >
                        <img src="{{asset('/baiviet/'.$getPost['post_image'])}}" height="100" width="100">
                    </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Danh mục bài viết</label>
                        <select name="cate_post_id" class="form-control input-sm m-bot15">
                            @foreach($cate_post as $value)
                            	@if($value['id'] == $getPost['cate_post_id'])
                                <option selected value="{{$value['id']}}">{{$value['cate_post_name']}}</option>
                                @else
                                <option value="{{$value['id']}}">{{$value['cate_post_name']}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                    <p><a href="{{url('admin/post/all')}}"  class="btn btn-success">Back</a></p>
                </form>
            </div>
        </section>

        </div>
        </div>


        <!-- page end-->
        </div>
</section>
@endsection