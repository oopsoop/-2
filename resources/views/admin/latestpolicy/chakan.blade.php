@extends('layouts.app')
<style>
     #box{
         width:auto;
         height: auto;
         border:1px solid red;
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
     ul{list-style-type: none;}
     #ul1{border-bottom: 2px solid #8B4513;height: 32px;}
     #ul1 li{display: inline-block;width: 60px;line-height: 30px;text-align: center;border: 1px solid #999;border-bottom: none;margin-left: 5px;}
     .show{display: block;}.hide{display: none;}



     a:hover,a:focus{
         outline: none;
         text-decoration: none;
     }
     .tab .nav-tabs{
         padding-left: 15px;
         border-bottom: 4px solid #692f6c;
     }
     .tab .nav-tabs li a{
         color: #fff;
         padding: 10px 20px;
         margin-right: 10px;
         background: #692f6c;
         text-shadow: 1px 1px 2px #000;
         border: none;
         border-radius: 0;
         opacity: 0.5;
         position: relative;
         transition: all 0.3s ease 0s;
     }
     .tab .nav-tabs li a:hover{
         background: #692f6c;
         opacity: 0.8;
         color : #fff;
     }
     .tab .nav-tabs li.active a{
         opacity: 1;
     }
     .tab .nav-tabs li.active a,
     .tab .nav-tabs li.active a:hover,
     .tab .nav-tabs li.active a:focus{
         color: #fff;
         background: #692f6c;
         border: none;
         border-radius: 0;
     }
     .tab .nav-tabs li a:before,
     .tab .nav-tabs li a:after{
         content: "";
         border-top: 42px solid transparent;
         position: absolute;
         top: -2px;
     }
     .tab .nav-tabs li a:before{
         border-right: 15px solid #692f6c;
         left: -15px;
     }
     .tab .nav-tabs li a:after{
         border-left: 15px solid #692f6c;
         right: -15px;
     }
     .tab .nav-tabs li a i,
     .tab .nav-tabs li.active a i{
         display: inline-block;
         padding-right: 5px;
         font-size: 15px;
         text-shadow: none;
     }
     .tab .nav-tabs li a span{
         display: inline-block;
         font-size: 14px;
         letter-spacing: -9px;
         opacity: 0;
         transition: all 0.3s ease 0s;
     }
     .tab .nav-tabs li a:hover span,
     .tab .nav-tabs li.active a span{
         letter-spacing: 1px;
         opacity: 1;
         transition: all 0.3s ease 0s;
     }
     .tab .tab-content{
         padding: 30px;
         background: #fff;
         font-size: 16px;
         color: #6c6c6c;
         line-height: 25px;
     }
     .tab .tab-content h3{
         font-size: 24px;
         margin-top: 0;
     }
     @media only screen and (max-width: 479px){
         .tab .nav-tabs li{
             width: 100%;
             margin-bottom: 5px;
             text-align: center;
         }
         .tab .nav-tabs li a span{
             letter-spacing: 1px;
             opacity: 1;
         }
     }
    .active{
        color: #6c6c6c !important;
    }
     @media (min-width: 992px){
         .col-md-offset-3 {
             margin-left: 0 !important;
         }

     }
     @media (min-width: 992px){
         .col-md-6 {
             width: 100% !important;
         }
     }
     /*#edui1{*/
         /*width: 500px !important;*/
     /*}*/

    </style>
<link href="{{ url('adminlte/css/bootstrap-fileinput.css') }}" rel="stylesheet">

@section('content')
    {{--<h4 class="page-title">{{$showdata['page-title']}}</h4>--}}
    <h4 class="page-title">最新政策 / 详情</h4>
    {{--<span></span>--}}
    <form action = "{{url()->current()}}" method="post">
       <input type="hidden" name="is" value="1">
       <input type="hidden" id='pic' name="pic" value="">
        {{csrf_field()}}


    <div class="container" style="padding-left: 0;margin-left: 0">
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <div class="tab" role="tabpanel">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#Section1" aria-controls="home" role="tab" data-toggle="tab">政策信息</a></li>
                    <li role="presentation"><a href="#Section2" aria-controls="profile" role="tab" data-toggle="tab">修改操作日志</a></li>
                    <li role="presentation"><a href="#Section3" aria-controls="messages" role="tab" data-toggle="tab">新增操作日志</a></li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content tabs">
                    <div role="tabpanel" class="tab-pane fade in active" id="Section1">

                        <div class="row">
                        <div class="col-xs-12 form-group">
                        <label for="article_name" class="control-label">文章名称</label>
                        <input type="text" class="form-control" name="article_name" id="article_name"  placeholder="文章名称" value="@if(!empty(old('article_name'))){{old('article_name')}}@else{{$corp['article_name']}}@endif">

                        <p class="help-block"></p>
                        @if($errors->has('article_name'))
                        <p class="help-block">
                        {{ $errors->first('article_name') }}
                        </p>
                        @endif
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-xs-12 form-group">
                        <label for="sortby" class="control-label">排序</label>
                        <input type="text" class="form-control" name="sortby" id="sortby"  placeholder="排序" value="@if(!empty(old('sortby'))){{old('sortby')}}@else{{$corp['sortby']}}@endif">

                        <p class="help-block"></p>
                        @if($errors->has('sortby'))
                        <p class="help-block">
                        {{ $errors->first('sortby') }}
                        </p>
                        @endif
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-xs-12 form-group" >
                        {{--<label for="" class="control-label" style="vertical-align: middle">封面图片</label>--}}
                        {{--<input type="text" class="form-control" name="pic" id="pic"   placeholder="封面图片" value="{{old('pic')}}">--}}

                        {{--<div id="uploadpic" class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 10px;">--}}
                        <ul class="docs-pictures clearfix">
                            <img data-original="@if(!empty(old('pic'))){{old('pic')}}@else{{$corp['pic']}}@endif" src = "@if(!empty(old('pic'))){{old('pic')}}@else{{$corp['pic']}}@endif" alt = "" style="width:230px">
                        </ul>
                        {{--</div>--}}
                        查看大图
                        {{--<button type="button" class="uploadSubmit  btn btn-info" class="btn btn-info">提交</button>--}}
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-xs-12 form-group">

                        <div class="col-sm-5" style="padding-left: 0px;width:auto">
                        <label for="" class="control-label">内容</label>
                        <script style="width:1000px;height:280px" id="ucontainer" name="cnt" >{!! $corp['cnt'] !!}</script>
                        </div>


                        </div>
                        </div>


                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="Section2">
                        {!! $history  !!}

                    </div>
                </div>
                    <div role="tabpanel" class="tab-pane fade" id="Section3">
                       {!! $addhistory  !!}
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>


    </form>

@stop

@section('javascript')
    <link href="{{ url('adminlte/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('adminlte/css/timeline23.css') }}" rel="stylesheet">
    <link href="{{ url('adminlte/dist/viewer.css') }}" rel="stylesheet">
    <link href="{{ url('adminlte/dist/main.css') }}" rel="stylesheet">
    <script  src="{{ url('adminlte/dist/jquery.min.js') }}"></script>
    <script  src="{{ url('adminlte/dist/bootstrap.min.js') }}"></script>
    <script  src="{{ url('adminlte/dist/viewer.js') }}"></script>
    <script  src="{{ url('adminlte/dist/main23.js') }}"></script>
    @include('vendor.ueditor.assets')
    {{--<!-- 实例化编辑器 -->--}}
    <script type="text/javascript">



      var ue = UE.getEditor('ucontainer');
      ue.ready(function() {
//          ue.setHeight(280);

          ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
      });

//  </script>


@endsection
