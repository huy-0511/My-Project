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
                Thêm Thương Hiệu
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
                <form>
                        @csrf 
                 
                    <div class="form-group">
                        <label for="exampleInputPassword1">Chọn thành phố</label>
                          <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                        
                                <option value="">--Chọn tỉnh thành phố--</option>
                            @foreach($city as $key => $ci)
                                <option value="{{$ci['id']}}">{{$ci['name_city']}}</option>
                            @endforeach
                                
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Chọn quận huyện</label>
                          <select name="district" id="district" class="form-control input-sm m-bot15 district choose">
                                <option value="">--Chọn quận huyện--</option>
                                
                        </select>
                    </div>
                      <div class="form-group">
                        <label for="exampleInputPassword1">Chọn xã phường</label>
                          <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                <option value="">--Chọn xã phường--</option>   
                        </select>
                    </div>
                     <div class="form-group">
                        <label for="exampleInputEmail1">Phí vận chuyển</label>
                        <input type="text" name="fee_ship" class="form-control fee_ship" id="exampleInputEmail1" placeholder="Tên danh mục">
                    </div>
                   
                    <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
                </form>
                </div>
                <div id="load_delivery">
                    
                </div>
            </div>
        </section>

        </div>
        </div>


        <!-- page end-->
        </div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
        fetch_delivery();
        function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                    url: "{{url('admin/select-feeship')}}",
                    method: "POST",
                    data: {_token:_token},
                    success: function (data) {
                        $('#load_delivery').html(data);

                    },
                    error: function() {
                       console.log(t);
                    }
                });
        }
        //blur không cần phải gửi token
        $(document).on('blur','.fee_feeship_edit',function(){
            var feeship_id = $(this).data('feeship_id');// lấy id 
            var fee_value = $(this).text();
            var _token = $('input[name="_token"]').val();
           $.ajax({
                    url: "{{url('admin/update-feeship')}}",
                    method: "POST",
                    data: {feeship_id:feeship_id,fee_value:fee_value,_token:_token},
                    success: function (data) {
                        fetch_delivery();

                    },
                    error: function() {
                       console.log(t);
                    }
                });

        });   
        $('.add_delivery').click(function(){
            var city = $('.city').val();
            var district = $('.district').val();
            var wards = $('.wards').val();
            var fee_ship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();
             $.ajax({
                    url: "{{url('admin/insert-delivery')}}",
                    method: "POST",
                    data: {city:city,district:district,wards:wards,fee_ship:fee_ship,_token:_token},
                    success: function (data) {
                 
                        fetch_delivery();
                    },
                    error: function() {
                       console.log(t);
                    }
                });
        });
            $('.choose').on('change',function(){
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = ' ';
                if(action == 'city'){
                    result = 'district';
                }else{
                    result = 'wards';
                }
               $.ajax({
                        url: "{{url('admin/select-delivery')}}",
                        method: "POST",
                        data: {action:action,ma_id:ma_id,_token:_token},
                        success: function (data) {
                            $('#'+result).html(data);

                        },
                        error: function() {
                           console.log(t);
                        }
                    });
            });
    })

</script>
@endsection