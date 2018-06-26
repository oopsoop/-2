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
<link href="{{ url('adminlte/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@section('content')
    <h3 class="page-title">{{$showdata['page-title']}}</h3>
    <script>
     function hook(){


         $('#myform').submit(function() {

             if($('#uploadpic img').length){
                 $("#pic").val($('#uploadpic img')[0].src);
             }else{
                 $("#pic").val(null);
             }


             return true; // return false to cancel form action
         });
     }
</script>
    <form action = "{{url()->current()}}" id="myform" method="post">

       <input type="hidden" name="is" value="1">
       <input type="hidden" id='pic' name="pic" value="">
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
            新闻资讯 / 新增
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="title" class="control-label">文章标题</label>
                    <input type="text" class="form-control" name="title" id="title"  placeholder="文章标题" value="{{old('title')}}">

                   <p class="help-block"></p>
                    @if($errors->has('title'))
                        <p class="help-block">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="intro" class="control-label">文章介绍</label>
                    <input type="text" class="form-control" name="intro" id="intro"  placeholder="文章介绍" value="{{old('intro')}}">

                   <p class="help-block"></p>
                    @if($errors->has('intro'))
                        <p class="help-block">
                            {{ $errors->first('intro') }}
                        </p>
                    @endif
                </div>
            </div>
            {{--<div class="row">--}}
                {{--<div class="col-xs-12 form-group">--}}
                    {{--<label for="sortby" class="control-label">排序</label>--}}
                    {{--<input type="text" class="form-control" name="sortby" id="sortby"  placeholder="排序" value="{{old('sortby')}}">--}}

                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('sortby'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('sortby') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}



             <div class="row">
                <div class="col-xs-12 form-group" >
                    <label for="" class="control-label" style="vertical-align: middle">封面图片</label>
                    {{--<input type="text" class="form-control" name="pic" id="pic"   placeholder="封面图片" value="{{old('pic')}}">--}}
                     <div class="fileinput fileinput-exists " data-provides="fileinput" id="exampleInputUpload" style="vertical-align: middle">
                            <div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">
                                <img id="picImg" style="width: 100%;height: auto;max-height: 140px;" src="/default-pic.png" alt="">
                            </div>
                            <div id="uploadpic" class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>
                            <div>
                                <span class="btn btn-primary btn-file">
                                    <span class="fileinput-new">选择图片</span>
                                    <span class="fileinput-exists">选择图片</span>
                                    <input type="hidden" value="" name=""><input type="file" data-oop="oopsoop" data-pic="" name="" id="picID" accept="image/gif,image/jpeg,image/x-png">
                                </span>
                                <a href="javascript:;" id="sdop" class="mmp btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                            </div>
                            {{--<button type="button" class="uploadSubmit  btn btn-info" class="btn btn-info">提交</button>--}}

                     </div>
                 </div>
             </div>

             <div class="row">
                <div class="col-xs-12 form-group">

                    <div class="col-sm-5" style="padding-left: 0px;width:auto">
                        <label for="container" class="control-label">内容</label>
                        <script  id="container" name="content" >{!! old('content') !!}</script>
                    </div>

                   <p class="help-block"></p>
                    @if($errors->has('content'))
                        <p class="help-block">
                            {{ $errors->first('content') }}
                        </p>
                    @endif
                </div>
            </div>
            {{--<div class="row">--}}
                {{--<div class="col-xs-12 form-group">--}}
                {{--<label for="status_id" class="control-label">状态</label>--}}

                {{--<select name="status_id" id="status_id" class="form-control input-sm js-example-basic-single-status">--}}
                {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('status_id'))--}}
                        {{--<p class="help-block">--}}
                        {{--{{ $errors->first('status_id') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}

        </div>
    </div>


       </div>
           <input class="btn btn-danger" onclick="hook();" type="submit" value="保存">
                       <input class="btn btn-danger" onclick="{{cancel()}}" type="button" value="取消">

       </div>
        </div>
    </form>

@stop

@section('javascript')
    @include('vendor.ueditor.assets')
    <!-- 实例化编辑器 -->
    <script type="text/javascript">
      var ue = UE.getEditor('container');
      ue.ready(function() {
          ue.setHeight(280);
          ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.

      });

  </script>
    <script src="{{ url('adminlte/js') }}/bootstrap-fileinput.js"></script>



    <!-- 日历开始 -->
    {{--<link href="{{ url('adminlte/css') }}/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">--}}
    {{--<script type="text/javascript" src="{{ url('adminlte/js') }}/bootstrap-datetimepicker.js" charset="UTF-8"></script>--}}
    {{--<script type="text/javascript" src="{{ url('adminlte/js') }}/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>--}}
    {{--<script type="text/javascript">--}}
    {{--// 日历选择--}}
    {{--$('#intellectualapply_time').datetimepicker({--}}
    {{--language:  'zh-CN',--}}
    {{--format: 'yyyy-mm-dd',--}}
    {{--weekStart: 1,--}}
    {{--todayBtn:  1,--}}
    {{--autoclose: 1,--}}
    {{--todayHighlight: 1,--}}
    {{--startView: 2,--}}
    {{--minView: 2,--}}
    {{--forceParse: 0--}}
    {{--});--}}
    {{--</script>--}}
    {{--<script>--}}
{{--//        $(function(){--}}
            {{--var my_status_data ={!! $showdata['status_t'] !!};--}}

            {{--$("#status_id").select2({--}}
                {{--data: my_status_data,--}}
                {{--width:"140px"--}}

            {{--});--}}


            {{--function createXMLHttpRequest() {--}}
                {{--if (window.ActiveXObject) {--}}
                    {{--xhr = new ActiveXObject("Microsoft.XMLHTTP");--}}
                {{--} else if (window.XMLHttpRequest) {--}}
                    {{--xhr = new XMLHttpRequest();--}}
                {{--}--}}
            {{--}--}}

            {{--$(":file").each(function (index,ele) {--}}
                {{--$(ele).change(function () {--}}
                    {{--var fileObj = $(this)[0].files[0];--}}
                    {{--var file_name = this.id;--}}
                    {{--console.log(file_name);--}}
                    {{--var FileController = '/file_save';--}}
                    {{--var form = new FormData();--}}
                    {{--form.append("file", fileObj);--}}
                    {{--form.append("_token","{{ csrf_token() }}");--}}
                    {{--createXMLHttpRequest();--}}
                    {{--xhr.open("post", FileController, true);--}}
                    {{--xhr.send(form);--}}
                    {{--xhr.onreadystatechange = function() {--}}
                        {{--if (xhr.readyState == 4 && xhr.status == 200) {--}}
                            {{--// json对象转换--}}
                            {{--var redata = JSON.parse(xhr.responseText);--}}
                            {{--var url = redata.url;--}}
                            {{--$('#photoCover-'+file_name).val(redata.path);--}}
                            {{--$('#photoCoverimg-'+file_name).html('<img src="'+url+'"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width:220px" >');--}}
                            {{--$(this)[0] = [];--}}
                        {{--} else {--}}
                        {{--}--}}
                    {{--}--}}
                {{--});--}}

            {{--});--}}




{{--//        });--}}
{{--//    </script>--}}
@endsection
