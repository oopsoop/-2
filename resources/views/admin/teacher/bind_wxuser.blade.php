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


@section('content')


    <form action = "{{url()->current()}}" id="myform" method="post">

       <input type="hidden" name="is" value="1">
       <input type="hidden" name="course_id" value="{{$corp->id}}">
        {{csrf_field()}}

            <div id="menu_content">
       <div class="panel panel-default is_show level" >
        <div class="panel-heading">
            排课时间表
        </div>

            <div class="panel-body" >
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="course_name" class="control-label">课程名称</label>
                    <input type="text" class="form-control" name="course_name" id="course_name"  placeholder="课程名称" value="@if(!empty(old('course_name'))){{old('course_name')}}@else{{$corp['course_name']}}@endif">

                   <p class="help-block"></p>
                    @if($errors->has('course_name'))
                        <p class="help-block">
                            {{ $errors->first('course_name') }}
                        </p>
                    @endif
                </div>
            </div>


        <button id="more" type="button" class="btn btn-default" aria-label="Left Align">
        <span class="glyphicon glyphicon-plus" aria-hidden="true">创建新课时</span>
        </button>

    </div>


       </div>

            <br>
            <br>
           <input class="btn btn-danger" __onclick="hook();" type="submit" value="保存">

       </div>
        </div>
    </form>

@stop

@section('javascript')



<script>

    $(function(){

    });


</script>



@endsection
