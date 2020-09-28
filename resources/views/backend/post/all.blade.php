@extends('backend.master')
@section('content')
<section id="main-content">
	<section class="wrapper">
		<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     	Liệt kê bài viết
    </div>
 <!--    <div class="row w3-res-tb">
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
           
            <th>Tên bài viết</th>
            <th>Hình ảnh</th>
            <th>Slug</th>
            <th>Mô tả bài viết</th>
            <th>Từ khóa bài viết</th>
            <th>Danh mục bài viết</th>
            

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
          @foreach($all_post as $value)
          <tr>
            <td>{{$value['post_title']}}</td>
            <td><img src="{{asset('baiviet/'.$value['post_image'])}}" height="80" width="80"></td>
            <td>{{$value['post_slug']}}</td>
            <td>{!!$value['post_desc']!!}</td>
            
            <td>
             	{{$value['post_meta_keywords']}}
            </td>
            <td>
              @foreach($cate_post as $value1)
                @if($value1['id'] == $value['cate_post_id'])
                  {{$value1['cate_post_name']}}
                @endif 
              @endforeach
            </td>

             <td>
              <a href="{{url('admin/post/edit/'.$value['id'])}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có chắc là muốn xóa danh mục này ko?')" href="{{url('admin/post/delete/'.$value['id'])}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>

         @endforeach
        </tbody>
        
      </table>
      <p><a href="{{url('admin/post/add')}}" class="btn btn-success" style="float: right;">Add</a></p>
    </div>
  
  </div>
</div>
@endsection