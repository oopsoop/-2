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

@section('content')

    <form action = "{{url()->current()}}" id="myform" method="post">

       <input type="hidden" name="is" value="1">
       <input type="hidden" id='stadium_pic' name="stadium_pic" value="">
        {{csrf_field()}}
        <div id="box">

       <div id="menu_content">
       <div class="panel panel-default is_show level" >
        <div class="panel-heading">
            二维码
        </div>

        <div class="panel-body">
             <div class="row">

                <label style="margin-left: 15px;" class="control-label">场馆二维码</label>
                <div style="margin-left: 15px;" class="divOne" >
                    <img  src="http://www.gbtags.com/gb/qrcode?t={{ $qrcode_url }}" alt="">
                </div>
            </div>
        </div>


       </div>
           {{--<input class="btn btn-danger" onclick="hook();" type="submit" value="保存">--}}
           <input class="btn btn-danger" onclick="{{cancel()}}" type="button" value="返回">

       </div>
        </div>
    </form>

@stop

@section('javascript')

<script>

</script>

@endsection
