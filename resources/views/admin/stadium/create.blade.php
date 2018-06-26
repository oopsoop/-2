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

    <script src="https://cdn.bootcss.com/jquery/2.2.1/jquery.min.js"></script>
<script src="{{ url('adminlte/js/app.min.js') }}"></script>
<link href="{{ url('adminlte/css/bootstrap-fileinput.css') }}" rel="stylesheet">
<script src="{{ url('adminlte/js') }}/bootstrap-fileinput.js"></script>
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
            场馆新增
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="stadium_name" class="control-label">场馆名称<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="stadium_name" id="stadium_name"  placeholder="场馆名称" value="{{old('stadium_name')}}">

                   <p class="help-block"></p>
                    @if($errors->has('stadium_name'))
                        <p class="help-block">
                            {{ $errors->first('stadium_name') }}
                        </p>
                    @endif
                </div>
            </div>

            {{--<div class="row">--}}
                {{--<div class="col-xs-12 form-group">--}}
                    {{--<label for="course_grade" class="control-label">编号</label>--}}
                    {{--<select name = "no_id" id = "no_id" class="form-control">--}}
                     {{--foreach($no_ids as $k=>$no_id): ?>--}}
                        {{--<option value = ' echo $no_id;?>'> echo $k; ?></option>--}}
                     {{--endforeach;?>--}}

                    {{--</select>--}}
                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('no_id'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('no_id') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}



            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="district" class="control-label">地址<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="district" id="district"  placeholder="地址" value="{{old('district')}}">

                   <p class="help-block"></p>
                    @if($errors->has('district'))
                        <p class="help-block">
                            {{ $errors->first('district') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="latitude" class="control-label">纬度</label>
                    <input type="text" class="form-control" name="latitude" id="latitude"  placeholder="纬度" value="{{old('latitude')}}">

                   <p class="help-block"></p>
                    @if($errors->has('latitude'))
                        <p class="help-block">
                            {{ $errors->first('latitude') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="longitude" class="control-label">经度</label>
                    <input type="text" class="form-control" name="longitude" id="longitude"  placeholder="经度" value="{{old('longitude')}}">

                   <p class="help-block"></p>
                    @if($errors->has('longitude'))
                        <p class="help-block">
                            {{ $errors->first('longitude') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="distance" class="control-label">设置范围  <span style="color: red;">米</span></label>
                    <input type="text" class="form-control" name="distance" id="distance"  placeholder="设置范围">

                   <p class="help-block"></p>

                    @if($errors->has('distance'))
                        <p class="help-block">
                            {{ $errors->first('distance') }}
                        </p>
                    @endif
                </div>
            </div>

            {{--<div class="row">--}}
                {{--<div class="col-xs-12 form-group">--}}
                    {{--<label for="search_addr" class="control-label">搜索地址</label>--}}
                    {{--<input type="text" class="form-control" name="search_addr" id="search_addr"  placeholder="搜索地址" value="{{old('search_addr')}}">--}}

                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('search_addr'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('search_addr') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}

             {{--<div class="row">--}}
                {{--<div class="col-xs-12 form-group" >--}}
                    {{--<label for="" class="control-label" style="vertical-align: middle">封面图片</label>--}}
                    {{--<input type="text" class="form-control" name="pic" id="pic"   placeholder="封面图片" value="{{old('pic')}}">--}}
                     {{--<div class="fileinput fileinput-exists " data-provides="fileinput" id="exampleInputUpload" style="vertical-align: middle">--}}
                            {{--<div class="fileinput-new thumbnail" style="width: 200px;height: auto;max-height:150px;">--}}
                                {{--<img id="picImg" style="width: 100%;height: auto;max-height: 140px;" src="/default-pic.png" alt="">--}}
                            {{--</div>--}}
                            {{--<div id="uploadpic" class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;"></div>--}}
                            {{--<div>--}}
                                {{--<span class="btn btn-primary btn-file">--}}
                                    {{--<span class="fileinput-new">选择图片</span>--}}
                                    {{--<span class="fileinput-exists">选择图片</span>--}}
                                    {{--<input type="hidden" value="" name=""><input type="file" data-oop="oopsoop" data-pic="" name="" id="picID" accept="image/gif,image/jpeg,image/x-png">--}}
                                {{--</span>--}}
                                {{--<a href="javascript:;" id="sdop" class="mmp btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>--}}
                            {{--</div>--}}
                            {{--<button type="button" class="uploadSubmit  btn btn-info" class="btn btn-info">提交</button>--}}

                     {{--</div>--}}
                 {{--</div>--}}
             {{--</div>--}}
            <div class="row">
                <div class="col-xs-12 form-group" >
                    <label for="" class="control-label" style="vertical-align: middle">导览图</label>
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

            {{--<article class="doc-content" style="overflow: hidden;">--}}
                    {{--<div class="index-content clearfix">--}}
                        {{--<iframe src="http://lbs.qq.com/tool/getpoint/getpoint.html" style="width:100%; height:727px; border:none;" hasanylase="1"></iframe>--}}
                        {{--<div style="clear:both"></div>--}}
                    {{--</div>--}}
                {{--</article>--}}

            {{--<div class="col-md-1-5 form-group" style="padding-left: 0px">--}}
                   {{--<label for="pic_student_abroad" class="control-label">导览图</label>--}}
                   {{--<input  type="file" name="" data-icon="false" data-classbutton="btn btn-default" data-classinput="form-control inline v-middle input-s" id="pic_student_abroad" tabindex="-1" style="position: absolute; clip: rect(0px 0px 0px 0px);"><div class="bootstrap-filestyle input-group"><input type="text" class="form-control" name="pic_student_abroad" value="" id="photoCover-pic_student_abroad" readonly> <span class="group-span-filestyle input-group-btn" tabindex="0"><label for="pic_student_abroad" class="btn btn-default "><span class="glyphicon glyphicon-folder-open"></span>  上传导览图</label></span></div>--}}
                    {{--<div id="photoCoverimg-pic_student_abroad">--}}

                            {{--<img  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width: 90px;visibility: hidden">--}}
                            {{--<input type = "hidden" name="stadium_pic" id="stadium_pic" value="">--}}
                    {{--</div>--}}
                   {{--<p class="help-block"></p>--}}
                 {{--@if($errors->has('pic_student_abroad'))--}}
                     {{--<p class="help-block">--}}
                            {{--{{ $errors->first('pic_student_abroad') }}--}}
                        {{--</p>--}}
                 {{--@endif--}}
                {{--</div>--}}
             {{--<div class="row">--}}
                {{--<div class="col-xs-12 form-group">--}}

                    {{--<div class="col-sm-5" style="padding-left: 0px;width:auto">--}}
                        {{--<label for="container" class="control-label">内容</label>--}}
                        {{--<script  id="container" name="content" >{!! old('content') !!}</script>--}}
                    {{--</div>--}}

                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('content'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('content') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
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


    {{--@include('vendor.ueditor.assets')--}}
    {{--<!-- 实例化编辑器 -->--}}
    {{--<script type="text/javascript">--}}
      {{--var ue = UE.getEditor('container');--}}
      {{--ue.ready(function() {--}}
          {{--ue.setHeight(280);--}}
          {{--ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.--}}

      {{--});--}}

  {{--</script>--}}

    <script>
//            var head_list = document.getElementById("head_list");
//            var menu_content = document.getElementById("menu_content");
////            var oli = head_list.getElementsByTagName("input");//获取tab列表
////            var odiv = menu_content.querySelectorAll("div.level");
//            for(var i=0 ; i<oli.length ; i++){
//                oli[i].index = i;//定义index变量，以便让tab按钮和tab内容相互对应
//                oli[i].onclick = function( ){//移除全部tab样式和tab内容
//                    for(var i =0; i < oli.length; i++){
//                        oli[i].className = "";
//                        odiv[i].style.display = "none";
//                    }
//                    this.className = "active";//为当前tab添加样式
//                    odiv[this.index].style.display="block";//显示当前tab对应的内容
//                }
//            }
    </script>


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
<script>
//    var xhr;
//
//    function createXMLHttpRequest() {
//    if (window.ActiveXObject) {
//    xhr = new ActiveXObject("Microsoft.XMLHTTP");
//    } else if (window.XMLHttpRequest) {
//    xhr = new XMLHttpRequest();
//    }
//    }

    //                });

//    $(":file").each(function (index, ele) {

//    $(ele).change(function () {

    {{--if (ele.dataset.oop == 'oopsoop') {--}}
    {{--var fileObj   = $(this)[0].files[0];--}}
    {{--var file_name = this.id;--}}

    {{--var FileController = '/file_save';--}}
    {{--var form           = new FormData();--}}
    {{--form.append("file", fileObj);--}}
    {{--form.append("_token", "{{ csrf_token() }}");--}}
    {{--createXMLHttpRequest();--}}
    {{--xhr.open("post", FileController, true);--}}
    {{--xhr.send(form);--}}
    {{--xhr.onreadystatechange = function () {--}}
    {{--if (xhr.readyState == 4 && xhr.status == 200) {--}}
    {{--// json对象转换--}}
    {{--var redata      = JSON.parse(xhr.responseText);--}}
    {{--var url         = redata.url;--}}
    {{--ele.dataset.pic = url;--}}

    {{--$(this)[0] = [];--}}
    {{--} else {--}}
    {{--}--}}
    {{--}--}}
    {{--return false;--}}
    {{--}--}}

    {{--var fileObj   = $(this)[0].files[0];--}}

    {{--var file_name = this.id;--}}

    {{--var FileController = '/file_save';--}}
    {{--var form           = new FormData();--}}
    {{--form.append("file", fileObj);--}}
    {{--form.append("_token", "{{ csrf_token() }}");--}}
    {{--createXMLHttpRequest();--}}
    {{--xhr.open("post", FileController, true);--}}
    {{--xhr.send(form);--}}
    {{--xhr.onreadystatechange = function () {--}}
    {{--if (xhr.readyState == 4 && xhr.status == 200) {--}}
    {{--// json对象转换--}}
    {{--var redata = JSON.parse(xhr.responseText);--}}
    {{--var url    = redata.url;--}}

    {{--$('#stadium_pic').val(url);--}}
    {{--$('#photoCover-' + file_name).val(redata.path);--}}
    {{--$('#photoCoverimg-' + file_name).html('<img src="' + url + '"  class="img-responsive gonggongyasd" alt="Responsive image" style="margin-top:10px;width:220px" >');--}}
    {{--$(this)[0] = [];--}}
    {{--} else {--}}
    {{--}--}}
    {{--}--}}
    {{--});--}}

    {{--});--}}

//
</script>

@endsection
