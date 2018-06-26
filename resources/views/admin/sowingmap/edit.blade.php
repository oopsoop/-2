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
            <div id="head_list">
                {{--<input type="button" value="最新政策"  class="active"/>--}}
                {{--<input type="button" value="企业证件" />--}}
                {{--<input type="button" value="档案信息" />--}}
            </div>
       <div id="menu_content">
       <div class="panel panel-default is_show level" >
        <div class="panel-heading">
            轮播图 / 编辑
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="pic_name" class="control-label">图片名称</label>
                    <input type="text" class="form-control" name="pic_name" id="pic_name"  placeholder="图片名称" value="@if(!empty(old('pic_name'))){{old('pic_name')}}@else{{$corp['pic_name']}}@endif">

                   <p class="help-block"></p>
                    @if($errors->has('pic_name'))
                        <p class="help-block">
                            {{ $errors->first('pic_name') }}
                        </p>
                    @endif
                </div>
            </div>
             {{--<div class="row">--}}
                {{--<div class="col-xs-12 form-group">--}}
                    {{--<label for="sortby" class="control-label">排序</label>--}}
                    {{--<input type="text" class="form-control" name="sortby" id="sortby"  placeholder="排序" value="@if(!empty(old('sortby'))){{old('sortby')}}@else{{$corp['sortby']}}@endif">--}}

                   {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('sortby'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('sortby') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
            {{--<div class="col-xs-12 form-group">--}}
            {{--<label for="created_at" class="control-label">创建日期</label>--}}
            {{--<input disabled type="text" class="form-control" name="created_at" id="created_at"  placeholder="创建日期" value="@if(!empty(old('created_at'))){{old('created_at')}}@else{{$corp['created_at']}}@endif">--}}

            {{--<p class="help-block"></p>--}}
            {{--@if($errors->has('created_at'))--}}
            {{--<p class="help-block">--}}
            {{--{{ $errors->first('created_at') }}--}}
            {{--</p>--}}
            {{--@endif--}}
            {{--</div>--}}
            {{--</div>--}}



            {{--<div class="row">--}}
            {{--<div class="col-xs-12 form-group">--}}
            {{--<label for="pic" class="control-label">封面图片</label>--}}
            {{--<input type="text" class="form-control" name="pic" id="pic"   placeholder="封面图片" value="{{old('pic')}}">--}}

            {{--<p class="help-block"></p>--}}
            {{--@if($errors->has('pic'))--}}
            {{--<p class="help-block">--}}
            {{--{{ $errors->first('pic') }}--}}
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
                            <div id="uploadpic" class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;">
                                 <ul class="docs-pictures clearfix">
                                <img src = "@if(!empty(old('pic'))){{old('pic')}}@else{{$corp['pic']}}@endif" alt = "">
                                 </ul>
                            </div>
                            <div>
                                <span class="btn btn-primary btn-file">
                                    <span class="fileinput-new">选择图片</span>
                                    <span class="fileinput-exists">选择图片</span>
                                    <input type="hidden" value="" name=""><input type="file" data-oop="oopsoop" data-pic="" name="pic1" id="picID" accept="image/gif,image/jpeg,image/x-png">
                                </span>
                                <a href="javascript:;" id="sdop" class="mmp btn btn-warning fileinput-exists" data-dismiss="fileinput">移除</a>
                            </div>
                        {{--<button type="button" class="uploadSubmit  btn btn-info" class="btn btn-info">提交</button>--}}

                     </div>
                 </div>
             </div>


             {{--<div class="row">--}}
                {{--<div class="col-xs-12 form-group">--}}

                    {{--<div class="col-sm-5" style="padding-left: 0px;width:50%">--}}
                        {{--<label for="container" class="control-label">内容</label>--}}
                        {{--<script  id="container" name="content" >@if(!empty(old('content'))){!! old('content') !!}@else{!! $corp['content'] !!}@endif</script>--}}
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
    <link href="{{ url('adminlte/dist/viewer.css') }}" rel="stylesheet">
    <link href="{{ url('adminlte/dist/main.css') }}" rel="stylesheet">
    <script  src="{{ url('adminlte/dist/jquery.min.js') }}"></script>
    <script  src="{{ url('adminlte/dist/bootstrap.min.js') }}"></script>
    <script  src="{{ url('adminlte/dist/viewer.js') }}"></script>
    <script  src="{{ url('adminlte/dist/main23.js') }}"></script>
    <script src="{{ url('adminlte/js') }}/bootstrap-fileinput.js"></script>
    <script>
            var head_list = document.getElementById("head_list");
            var menu_content = document.getElementById("menu_content");
            var oli = head_list.getElementsByTagName("input");//获取tab列表
            var odiv = menu_content.querySelectorAll("div.level");
            for(var i=0 ; i<oli.length ; i++){
                oli[i].index = i;//定义index变量，以便让tab按钮和tab内容相互对应
                oli[i].onclick = function( ){//移除全部tab样式和tab内容
                    for(var i =0; i < oli.length; i++){
                        oli[i].className = "";
                        odiv[i].style.display = "none";
                    }
                    this.className = "active";//为当前tab添加样式
                    odiv[this.index].style.display="block";//显示当前tab对应的内容
                }
            }
        </script>

    {{--<script>--}}
{{--//        $(function(){--}}
            {{--var my_status_data ={!! $showdata['status_t'] !!};--}}
            {{--var current_status_id = "{!! $corp['status_id'] !!}";--}}
            {{--$("#status_id").select2({--}}
                {{--data: my_status_data,--}}
                {{--width:"140px"--}}

            {{--});--}}
            {{--$("#status_id").val(current_status_id).trigger("change");--}}





{{--//        });--}}
{{--//    </script>--}}
@endsection
