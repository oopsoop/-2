@extends('layouts.app')
<style>
     #box{
         width:auto;
         height: auto;
         /*background:lightgoldenrodyellow;*/

     }
     #container{
         /*height:230px;*/
         width :700px;
     }
     .my_btn_class{
         width: 70px;
         border: 1px solid #f5f5f5;
         color: #000;
         height: 38px;
         background-color: #f5f5f5;
     }
     #head_list input{

         width:70px;
     }

     .active{
         color: cornflowerblue;
     }
     .is_show{
         display: block;
     }
     .is_hidden{
         display: none;
     }
     .help-block{
         color:red !important;
     }
     .bootstrap-filestyle input{
         display: none !important;
     }
     .bootstrap-filestyle span{
         width: 17px !important;
     }

     .col-xs-1-8,.col-sm-1-8,.col-md-1-8,.col-lg-1-8 {
         min-height: 1px;
         padding-left: 15px;
         padding-right: 15px;
         position: relative;
     }

     .col-xs-1-8 {
         width: 12.5%;
         float: left;
     }

     @media (min-width: 768px) {
         .col-sm-1-8 {
             width: 12.5%;
             float: left;
         }
     }

     @media (min-width: 992px) {
         .col-md-1-8 {
             width: 12.5%;
             float: left;
         }
     }

     @media (min-width: 1200px) {
         .col-lg-1-8 {
             width: 12.5%;
             float: left;
         }
     }









     .col-xs-1-5,.col-sm-1-5,.col-md-1-5,.col-lg-1-5 {
         min-height: 1px;
         padding-left: 15px;
         padding-right: 15px;
         position: relative;
     }

     .col-xs-1-5 {
         width: 20%;
         float: left;
     }

     @media (min-width: 768px) {
         .col-sm-1-5 {
             width: 20%;
             float: left;
         }
     }

     @media (min-width: 992px) {
         .col-md-1-5 {
             width: 20%;
             float: left;
         }
     }

     @media (min-width: 1200px) {
         .col-lg-1-5 {
             width: 20%;
             float: left;
         }
     }
     .thumbnail{
         padding: 0 !important;
     }
</style>

      <link href="https://cdn.bootcss.com/select2/4.0.4/css/select2.min.css" rel="stylesheet">
{{--<link href="{{ url('adminlte/css/bootstrap-fileinput.css') }}" rel="stylesheet">--}}
{{--<script src="{{ url('adminlte/js') }}/bootstrap-fileinput.js"></script>--}}
@section('content')
    {{--<h3 class="page-title">{{$showdata['page-title']}}</h3>--}}
    <script>
     function hook(){


         $('#myform').submit(function() {

             if($('#uploadpic img').length){
                 $("#stadium_pic").val($('#uploadpic img')[0].src);
             }else{
                 $("#stadium_pic").val(null);
             }


             return true; // return false to cancel form action
         });
     }
</script>
    <form action = "{{url()->current()}}" id="myform" method="post">

       <input type="hidden" name="is" value="1">
       {{--<input type="hidden" id='stadium_pic' name="stadium_pic" value="">--}}
        {{csrf_field()}}
        <div id="box">
        {{--<div id="head_list">--}}
            {{--<input type="button" value="最新政策"  class="active"/>--}}
            {{--<input type="button" value="企业证件" />--}}
            {{--<input type="button" value="档案信息" />--}}
        {{--</div>--}}
       <div id="menu_content">
       <div class="panel panel-default is_show level" >
        <div class="panel-heading">
            新增教师
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="name" class="control-label">教师名称</label>
                    <input type="text" class="form-control" name="name" id="name"  placeholder="教师名称" value="{{old('name')}}">

                   <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                   <label for="account" class="control-label">教师账号</label>
                   <input type="text" class="form-control" name="account" id="account"  placeholder="输入教师账号" value="{{old('account')}}">

                   <p class="help-block"></p>
                    @if($errors->has('account'))
                        <p class="help-block">
                            {{ $errors->first('account') }}
                        </p>
                    @endif
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                   <label for="mobile" class="control-label"></label>
                   <input type="text" class="form-control" name="mobile" id="mobile"  placeholder="输入联系电话" value="{{old('mobile')}}">

                   <p class="help-block"></p>
                    @if($errors->has('mobile'))
                        <p class="help-block">
                            {{ $errors->first('mobile') }}
                        </p>
                    @endif
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                   <label for="nickName" class="control-label">微信昵称</label>
                   <input type="text" class="form-control" name="nickName" id="nickName"  placeholder="输入微信昵称" value="{{old('nickName')}}">

                   <p class="help-block"></p>
                    @if($errors->has('nickName'))
                        <p class="help-block">
                            {{ $errors->first('nickName') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="gender" class="control-label">性别</label>
                    {{--<input type="text" class="form-control" name="stadium_id" id="stadium_id"  placeholder="所在场馆" value="{{old('stadium_id')}}">--}}
                    <select name = "gender" id = "gender" class="form-control">
                    <?php $genderarr = ['1'=>'男','2'=>'女']; ?>
                    <?php foreach($genderarr as $k=>$kv): ?>
                        <option value = '<?php echo $k;?>'><?php echo $kv; ?></option>
                    <?php endforeach;?>

                    </select>
                   <p class="help-block"></p>
                    @if($errors->has('gender'))
                        <p class="help-block">
                            {{ $errors->first('gender') }}
                        </p>
                    @endif
                </div>
            </div>


            {{--<div class="row">--}}
                {{--<div class="col-xs-12 form-group">--}}
                   {{--<label for="default_num" class="control-label">默认人数</label>--}}
                   {{--<input type="text" class="form-control" name="default_num" id="default_num"  placeholder="默认人数" value="{{old('default_num')}}">--}}

                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('default_num'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('default_num') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="row">
                <div class="col-xs-12 form-group">
                   <label for="password" class="control-label">密码</label>
                   <input type="text" class="form-control" name="password" id="password"  placeholder="输入密码" value="{{old('password')}}">

                   <p class="help-block"></p>
                    @if($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                   <label for="password_confirmation" class="control-label">确认密码</label>
                   <input type="text" class="form-control" name="password_confirmation" id="password_confirmation"  placeholder="重复输入密码" value="{{old('password_confirmation')}}">

                   <p class="help-block"></p>
                    @if($errors->has('password_confirmation'))
                        <p class="help-block">
                            {{ $errors->first('password_confirmation') }}
                        </p>
                    @endif
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                   <label for="wechat" class="control-label">绑定教师微信</label>
                   <input type="text" class="form-control" name="wechat" id="wechat"  placeholder="输入微信号" value="{{old('wechat')}}">

                   <p class="help-block"></p>
                    @if($errors->has('wechat'))
                        <p class="help-block">
                            {{ $errors->first('wechat') }}
                        </p>
                    @endif
                </div>
            </div>
             {{--<div class="row">--}}
                {{--<div class="col-xs-12 form-group">--}}
                   {{--<label for="started_at" class="control-label">课程开始时间</label>--}}
                   {{--<input type="text" class="form-control" name="started_at" id="started_at"  placeholder="课程开始时间" value="{{old('started_at')}}">--}}

                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('started_at'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('started_at') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
             {{--<div class="row">--}}
                {{--<div class="col-xs-12 form-group">--}}
                   {{--<label for="end_at" class="control-label">课程结束时间</label>--}}
                   {{--<input type="text" class="form-control" name="end_at" id="end_at"  placeholder="课程结束时间" value="{{old('end_at')}}">--}}

                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('end_at'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('end_at') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}


        </div>
    </div>


       </div>
           <input class="btn btn-danger" __onclick="hook();" type="submit" value="保存">
                       <input class="btn btn-danger" onclick="{{cancel()}}" type="button" value="取消">

       </div>
        </div>
    </form>

@stop

@section('javascript')

    <!-- 日历开始 -->
    <link href="{{ url('adminlte/css') }}/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="{{ url('adminlte/js') }}/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ url('adminlte/js') }}/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script type="text/javascript">
// 日历选择
$('#started_at').datetimepicker({
    language:  'zh-CN',
    format: 'yyyy-mm-dd hh-ii',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});
$('#end_at').datetimepicker({
    language:  'zh-CN',
    format: 'yyyy-mm-dd hh-ii',
    weekStart: 1,
    todayBtn:  1,
    autoclose: 1,
    todayHighlight: 1,
    startView: 2,
    minView: 2,
    forceParse: 0
});
    </script>


    {{--<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>--}}
    {{--<script src="{{ url('adminlte/js/app.min.js') }}"></script>--}}

    <script src="https://cdn.bootcss.com/select2/4.0.4/js/select2.js"></script>
    <script>
    $(document).ready(function () {
        $('#stadium_id').select2();
        $('#course_grade').select2();
        $('#is_setup').select2();
    });
</script>


@endsection
