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
       <input type="hidden" id='stadium_pic' name="stadium_pic" value="">
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
            新增课程
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="course_name" class="control-label">课程名称<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="course_name" id="course_name"  placeholder="课程名称" value="{{old('course_name')}}">

                   <p class="help-block"></p>
                    @if($errors->has('course_name'))
                        <p class="help-block">
                            {{ $errors->first('course_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="stadium_id" class="control-label">所在场馆</label>
                    {{--<input type="text" class="form-control" name="stadium_id" id="stadium_id"  placeholder="所在场馆" value="{{old('stadium_id')}}">--}}
                    <select name = "stadium_id" id = "stadium_id" class="form-control">
                    <?php foreach($stadiumDatas as $k=>$tag): ?>
                        <option value = '<?php echo $tag;?>'><?php echo $k; ?></option>
                    <?php endforeach;?>

                    </select>
                   <p class="help-block"></p>
                    @if($errors->has('stadium_id'))
                        <p class="help-block">
                            {{ $errors->first('stadium_id') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="teacher_id" class="control-label">所属教师</label>
                    {{--<input type="text" class="form-control" name="teacher_id" id="teacher_id"  placeholder="所在场馆" value="{{old('teacher_id')}}">--}}
                    <select name = "teacher_id" id = "teacher_id" class="form-control">
                    <?php foreach($teacherDatas as $k1=>$tag1): ?>
                        <option value = '<?php echo $tag1;?>'><?php echo $k1; ?></option>
                    <?php endforeach;?>

                    </select>
                   <p class="help-block"></p>
                    @if($errors->has('teacher_id'))
                        <p class="help-block">
                            {{ $errors->first('teacher_id') }}
                        </p>
                    @endif
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12 form-group">
                   <label for="default_num" class="control-label">默认人数</label>
                   <input type="text" class="form-control" name="default_num" id="default_num"  placeholder="默认人数" value="{{old('default_num')}}">

                   <p class="help-block"></p>
                    @if($errors->has('default_num'))
                        <p class="help-block">
                            {{ $errors->first('default_num') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                   <label for="period" class="control-label">时间间隔设置[<span style="color: red">分</span>]</label>
                   <input type="text" class="form-control" name="period" id="period"  placeholder="时间间隔设置" value="{{old('period')}}">

                   <p class="help-block"></p>
                    @if($errors->has('period'))
                        <p class="help-block">
                            {{ $errors->first('period') }}
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
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="course_grade" class="control-label">系别</label>
                    <select name = "status_id" id = "status_id" class="form-control">
                    <?php foreach($xis as $k=>$status_id): ?>
                        <option value = '<?php echo $status_id;?>'><?php echo $k; ?></option>
                        <?php endforeach;?>

                    </select>
                   <p class="help-block"></p>
                    @if($errors->has('status_id'))
                        <p class="help-block">
                            {{ $errors->first('status_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="course_grade" class="control-label">课程等级</label>
                    <select name = "course_grade" id = "course_grade" class="form-control">
                    <?php foreach($course_grades as $k=>$course_grade): ?>
                        <option value = '<?php echo $course_grade;?>'><?php echo $k; ?></option>
                        <?php endforeach;?>

                    </select>
                   <p class="help-block"></p>
                    @if($errors->has('course_grade'))
                        <p class="help-block">
                            {{ $errors->first('course_grade') }}
                        </p>
                    @endif
                </div>
            </div>

             <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="is_setup" class="control-label">是否启用</label>
                    <select name = "is_setup" id = "is_setup" class="form-control">
                    <?php foreach($is_setups as $k=>$is_setup): ?>
                        <option value = '<?php echo $is_setup;?>'><?php echo $k; ?></option>
                        <?php endforeach;?>

                    </select>
                   <p class="help-block"></p>
                    @if($errors->has('is_setup'))
                        <p class="help-block">
                            {{ $errors->first('is_setup') }}
                        </p>
                    @endif
                </div>
            </div>

              <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="course_explain" class="control-label">课程介绍</label>
                    <textarea name = "course_explain" id = "course_explain" class="form-control" cols = "30" rows = "4">{{old('course_explain')}}</textarea>
                   <p class="help-block"></p>
                    @if($errors->has('course_explain'))
                        <p class="help-block">
                            {{ $errors->first('course_explain') }}
                        </p>
                    @endif
                </div>
            </div>

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
