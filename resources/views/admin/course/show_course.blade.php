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

     .btn-default {
         background-color: #f4f4f4;
         color: #444;
         border-color: #ddd;
         padding: 8px !important;
         padding-bottom: 11px !important;
     }
    #more{
        margin-left: 15px;
        margin-bottom: 15px;
        margin-top :15px;
    }
</style>

     <link href="https://cdn.bootcss.com/select2/4.0.4/css/select2.min.css" rel="stylesheet">

@section('content')

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
       <input type="hidden" name="course_id" value="{{$corp->id}}">
        {{csrf_field()}}
        <div id="box">

       <div id="menu_content">
       <div class="panel panel-default is_show level" >
        <div class="panel-heading">
            排课时间表
        </div>
        @if(count($corp->coursetable) > 0)
        @foreach($corp->coursetable as $k=>$item)
        <div class="panel-body" >
            <div class="row">
                <div class="col-xs-12 form-group">
                    {{--<label for="course_name" class="control-label">课程名称</label>--}}
                    <label for="course_name" class="control-label">课程场次</label>
                    <input type="text" class="form-control changci" name="course_name" id="course_name"  placeholder="课程场次" value="<?php echo '第'.($k+1).'场'; ?>">
                    {{--<input type="text" class="form-control" name="course_name" id="course_name"  placeholder="课程名称" value="@if(!empty(old('course_name'))){{old('course_name')}}@else{{$corp['course_name']}}@endif">--}}

                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('course_name'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('course_name') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                </div>
            </div>
            <input type = "hidden" name="default_num[]" value="{{$corp['default_num']}}">
            <div class="row">
                <div class="col-xs-12 form-group">
                   <label for="started_at" class="control-label">课程开始时间</label>
                   <input type="text" class="form-control time" name="started_at[]" id="started_at"  placeholder="课程开始时间" value="{{$item->started_at}}"  data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">
                   <input type = "hidden" name="id[]" value="{{$item->id}}">
                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('started_at'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('started_at') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                   <label for="end_at" class="control-label">课程结束时间</label>
                   <input type="text" class="form-control time" name="end_at[]" id="end_at"  placeholder="课程结束时间" value="{{$item->end_at}}">

                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('end_at'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('end_at') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                </div>
            </div>

            <div class="row">

                <label style="margin-left: 15px;" class="control-label">课时临时二维码</label>
                <div style="margin-left: 15px;" class="divOne" data-url="{{ $item->qrcode }}">
                    <img  src="http://www.gbtags.com/gb/qrcode?t={{ $item->qrcode }}" alt="">
                </div>
            </div>
        </div>
        @endforeach

        @else
            <div class="panel-body" >
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="course_name" class="control-label">课程场次</label>
                    <input type="text" class="form-control changci" name="course_name" id="course_name"  placeholder="课程场次" value="第1场">

                   <p class="help-block"></p>
                    @if($errors->has('course_name'))
                        <p class="help-block">
                            {{ $errors->first('course_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <input type = "hidden" name="default_num[]" value="{{$corp['default_num']}}">
            {{--<input type = "hidden" name="default_num[]" value="{{$corp['default_num']}}">--}}
            <div class="row">
                <div class="col-xs-12 form-group">
                   <label for="started_at" class="control-label">课程开始时间</label>
                   <input type="text" class="form-control time" name="started_at[]" id="started_at"  placeholder="课程开始时间" value=""  data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">


                </div>
            </div>
             <div class="row">
                <div class="col-xs-12 form-group">
                   <label for="end_at" class="control-label">课程结束时间</label>
                   <input type="text" class="form-control time" name="end_at[]" id="end_at"  placeholder="课程结束时间" value="">

                </div>
            </div>

            {{--<div class="row">--}}
                {{--<div class="input-group date form_time col-md-5" data-date="" data-date-format="hh:ii" data-link-field="dtp_input3" data-link-format="hh:ii">--}}
                    {{--<input class="form-control" size="16" type="text" value="" readonly>--}}
                    {{--<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>--}}
					{{--<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>
        @endif

        <button id="more" type="button" class="btn btn-default" aria-label="Left Align">
                  <span class="glyphicon glyphicon-plus" aria-hidden="true">创建新课时</span>
        </button>

    </div>


       </div>

            <br>
            <br>
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
//$('document').on('click','input',function(){

  //  alert(23);
//    $(this).datetimepicker({
//        language:  'zh-CN',
//        format: 'yyyy-mm-dd hh-ii',
//        weekStart: 1,
//        todayBtn:  1,
//        autoclose: 1,
//        todayHighlight: 1,
//        startView: 2,
//        minView: 2,
//        forceParse: 0
//    });
//});
//$('input').datetimepicker({
//    language:  'zh-CN',
//    format: 'yyyy-mm-dd hh-ii',
//    weekStart: 1,
//    todayBtn:  1,
//    autoclose: 1,
//    todayHighlight: 1,
//    startView: 2,
//    minView: 2,
//    forceParse: 0
//});
    </script>
    {{--// <script src="https://cdn.bootcss.com/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>--}}
<script>
    $(function(){
        // $('.divOne').each(function (i,k) {
        //     $(this).qrcode({width: 64,height: 64,text: this.dataset.url});
//               var qrcode= $(this).qrcode(this.dataset.url);
//               var canvas=qrcode.find('canvas').get(0);
//               $(this).find('img').attr('src',canvas.toDataURL('image/jpg'));
//               canvas.style.display='none';
        // });
//
//        $('.form_time').datetimepicker({
//            language:  'zh-CN',
//            autoclose: true,
//            format: 'hh-ii',
//            weekStart: 1,
//            minView: 0,
//            minuteStep: 1,
//            startView: 1,
//            maxView: 1,
//            forceParse: 0
//        });
        $(document).on('focus','input.time',function(){

            $(this).datetimepicker({
                autoclose: true,
                language:  'zh-CN',
                format: 'hh:ii',
                weekStart: 1,
                minView: 0,
                minuteStep: 1,
                startView: 1,
                maxView: 1,
                forceParse: 0
            });
        });
        $('#more').on('click', function () {
//            const tempNode = $('#ko').clone().removeAttr('id');


            const tempNode = $(this).prev("div.panel-body").clone().removeAttr('id');
            tempNode.find('input.changci').val('');
            tempNode.find('input.time').val('');
            tempNode.find("input[type='hidden']").remove();
            tempNode.find("img").remove();
            $(this).prev("div.panel-body").after(tempNode);

        });
    });
</script>

    {{--<script src="https://cdn.bootcss.com/select2/4.0.4/js/select2.js"></script>--}}
    {{--<script>--}}
    {{--$(document).ready(function () {--}}
{{--//        $('#stadium_id').select2();--}}
{{--//        $('#course_grade').select2();--}}
{{--//        $('#is_setup').select2();--}}
    {{--});--}}
{{--//</script>--}}


@endsection
