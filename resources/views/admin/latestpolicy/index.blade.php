@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')
<style>
    #table {border-collapse: collapse !important;width: 100%;max-width: 100%;margin-bottom: 20px;}
    #table td,.table th {background-color: #fff !important;}
    #table-bordered th,.table-bordered td {border: 1px solid #ddd !important;}
    #table tr td {padding: 8px;line-height: 1.42857143;vertical-align: middle;border-bottom: 1px solid #ddd;}
    #table tr:hover {background-color: #f5f5f5;}



    .switch-bg {
        width: 75px;
        height: 24px;
        background: #76d95c;
        border-radius: 50px;
        box-shadow:inset 0px 0px 3px;
        transition:all 0.5s;
    }
    .switch-block {
        width: 24px;
        height: 24px;
        background: #ffffff;
        border-radius: 50%;
        position: relative;
        top: -1px;
        left: 1px;
        box-shadow: 1px 3px 5px;
        transition:all 0.5s;
    }
    .turn-off {
        background: #ffffff;
    }
    .turn-off>.switch-block {
        left: 49px;
    }
</style>
@section('content')
    <h3 class="page-title">{{$showdata['page-title']}}</h3>
    <p>
        <a href="{{ url('admin/latestpolicy/create') }}" class="btn btn-success">{{$showdata['app_add_new']}}</a>
    </p>
    <script>
                function hook(){


                    $('#myform').submit(function() {

                        let oop = $('#province_id').val($('#provinces option:selected').val());

                        if(!$('#provinces option:selected').val()){
                            alert("请选择省份");
                            return false;
                        }
                        $('#city_id').val($('#citys option:selected').val());

                        return true; // return false to cancel form action
                    });

                }
    </script>
    <form id="myform" action="/admin/latestpolicy/index" method="get" class="form-inline">
       <input type="hidden" id='province_id' name="province_id" value="">
       <input type="hidden" id='city_id' name="city_id" value="">
        <div class="form-group">
        <label>分类：</label>
        <select name="status" id="status" class="form-control input-sm js-example-basic-single-status">
        </select>
        </div>

        <div class="form-group">
        <table>
                   <tr style="height: 38px;" >
                        <td>
                            <select id="provinces" class="form-control input-sm js-example-basic-single-status">
                                {{--<option value="" >请选择省份</option>--}}
                            </select>
                        </td>
                        <td>
                            <select id="citys" class="form-control input-sm js-example-basic-single-status">
                                {{--<option value="" >请选择市</option>--}}
                            </select>
                        </td>

                   </tr>
               </table>
        </div>

       <div class="form-group" style="margin-left:5px;">
         <label>开始日期：</label>
         <input type="text" class="input-sm form-control" name="kstime" id="kstime" placeholder="开始日期" value="@if($showdata['datac']['kstime'] != '1970-01-01 00:00:00'){{$showdata['datac']['kstime']}}@endif">
       </div>
       <div class="form-group" style="margin-left:5px;">
         <label>结束日期：</label>
         <input type="text" class="input-sm form-control" name="jstime" id="jstime" placeholder="结束日期" value="@if($showdata['datac']['jstime'] != '2100-12-30 23:59:59'){{$showdata['datac']['jstime']}}@endif">
       </div>




        <div class="form-group">
            <input type="hidden" name="pageno" id="pageno_change" value="{{$showdata['datac']['pageno']}}">
            <button class="btn btn-sm btn-default" onclick="hook();" type="submit" >查询</button>
        </div>

</form>
    <div class="panel panel-default">
        <div class="panel-heading">
            {{--@lang('global.app_list')--}}
            列表
        </div>

        <div class="panel-body table-responsive">
            <table id="table" class="table table-striped b-t b-light" style="font-size:12px;">
                <thead>
                    <tr>
                        <th>文章名称</th>
                        {{--<th>文章介绍</th>--}}
                        <th>项目分类</th>
                        {{--<th>排序</th>--}}
                        <th>省</th>
                        <th>市</th>
                        {{--<th>分类</th>--}}
                        <th>创建时间</th>
                        {{--<th>封面图片</th>--}}
                        <th>操作</th>
                    </tr>
                </thead>

                <tbody>
                    @if ($showdata['data']->count() > 0)
                        @foreach ($showdata['data'] as $proj)
                            <tr>
                                <td>{{ $proj->article_name }}</td>
{{--                                <td>{{ $proj->intro }}</td>--}}
                                <td>{{ $proj->status_name['status_name']}}</td>
{{--                                <td>{{ $proj->sortby }}</td>--}}
                                <td>{{ $proj->province_name['name'] }}</td>
                                <td>{{ $proj->city_name['name'] }}</td>
                                <td>{{ $proj->created_at }}</td>
{{--                                <td>{{ $proj->cnt }}</td>--}}
{{--                                <td>{{ $proj->company_info }}</td>--}}
{{--                                <td>{{ $proj->user_phone }}</td>--}}

                                <td>
                                    <a href="#" class="up">上移</a> <a href="#" class="down">下移</a> <a href="#" class="top">置顶</a>
                                    <a href="{{ url('admin/latestpolicy/update',[$proj->id]) }}" _class="btn btn-xs btn-info"><i class="fa fa-pencil text-success text" style="font-size: 15px;"></i>{{$showdata['app_edit']}}</a>
                                    <a href="{{ url('admin/latestpolicy/chakan',[$proj->id]) }}" _class="btn btn-xs btn-info"><i class="fa fa-pencil text-success text" style="font-size: 15px;"></i>{{$showdata['app_chakan']}}</a>
                                    <a href="javascript:;" onclick="del({{$proj->id}})"  _class="btn btn-xs btn-info"><i class="fa fa-times text-danger text" style="font-size: 15px;"></i>删除</a>
                                    前端是否显示：<?php $turnoff = $proj->status_id ? '':'turn-off' ?>;
                                          <div data-id="{{$proj->id}}" class="switch-bg <?php echo $turnoff; ?>" style="display: inline-block;vertical-align: middle;">
        <div class="switch-block"></div>
    </div>

                                    {{--{!! Form::open(array(--}}
                                    {{--'style' => 'display: inline-block;',--}}
                                    {{--'method' => 'DELETE',--}}
                                    {{--'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",--}}
                                    {{--'url' => ['admin/enterprise/del', $enterprise->id])) !!}--}}
                                    {{--{!! Form::submit("删除", array('class' => 'btn btn-xs btn-danger')) !!}--}}
                                    {{--{!! Form::close() !!}--}}
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
         <footer class="panel-footer">
            <div class="row">
              <div class="col-sm-9">
                <div  style="float: left;">
                  @if($showdata['data']->count() > 0)
                        {!! $showdata['data']->appends($showdata['input'])->links() !!}
                    @endif
                </div>

              </div>

            <div style="float: left;">
                  <input type="text" name="page" onchange="page_gai()" id="page_change" value="{{@$_GET['page']}}" class="form-control input-sm" style="display:inline-block;width: 45px;text-align:center;padding: 5px 0;margin: 20px 0 0 20px;vertical-align: bottom;" />
                  {{--<a id="tiao" href="@if($showdata['data']->count() > 0){!! $showdata['data']->appends($showdata['input'])->url(@$_GET['page']) !!}@endif">--}}
                  <a id="tiao" href="{!! $showdata['data']->appends($input)->url(@$_GET['page']) !!}">
                      <button class="btn btn-sm btn-default" style="margin-top: -4px;">跳转</button>
                  </a>
                </div>
            </div>
          </footer>
    </div>
@stop

@section('javascript')
   <script>
         // 页面跳转

         function page_gai(){
             var url = $('#tiao').attr('href');
             var m =url.length;
             var n = url.indexOf('page=');
             var j = url.substring(n,m);
             var s = url.replace(j,'page='+$('#page_change').val());
             $('#tiao').attr('href',s);
         }
   </script>
    <!-- 日历开始 -->
    <link href="{{ url('adminlte/css') }}/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="{{ url('adminlte/js') }}/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="{{ url('adminlte/js') }}/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script type="text/javascript">
    // 日历选择
    $('#kstime').datetimepicker({
        language:  'zh-CN',
        format: 'yyyy-mm-dd',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    $('#jstime').datetimepicker({
        language:  'zh-CN',
        format: 'yyyy-mm-dd',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
  </script>

    <!-- 日历结束 -->

    <script>
          function del(id) {
              layer.confirm('您确定要删除吗？', {
                  btn: ['确定','取消'] //按钮
              }, function(){
                  $.post("/admin/latestpolicy/destroy/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                      if(data.statu==1){
                          layer.msg(data.msg);
                          location.href = location.href;
                      }else if(data.statu==3){
                          layer.msg(data.msg);
                      }else{
                          layer.msg(data.msg);
                      }
                  });
              }, function(){

              });
          }
    </script>

    <script>
        $(document).ready(function(){



//            $(".switch-bg").click(function(){
//                if($(this).hasClass("turn-off")){
//                    $(this).removeClass("turn-off");
//                    return;
//                }
//                $(this).addClass("turn-off");
//            });
            //上移
            var $up = $(".up")
            $up.click(function() {
                var $tr = $(this).parents("tr");
                if ($tr.index() != 0) {
                    $tr.fadeOut().fadeIn();
                    $tr.prev().before($tr);
                }
            });
            //下移
            var $down = $(".down");
            var len = $down.length;
            $down.click(function() {
                var $tr = $(this).parents("tr");
                if ($tr.index() != len - 1) {
                    $tr.fadeOut().fadeIn();
                    $tr.next().after($tr);
                }
            });
            //置顶
            var $top = $(".top");
            $top.click(function(){
                var $tr = $(this).parents("tr");
                $tr.fadeOut().fadeIn();
                $("#table").prepend($tr);
//                $tr.css("color","#f60");
            });

            var my_status_data = {!! $showdata['status_t'] !!};
            var province = {!! $showdata['provinces'] !!};
            var city = {!! $showdata['citys'] !!};

            $("#status").select2({
                data: my_status_data,
                width:"140px"

            });$("#provinces").select2({
                data: province,
                width:"140px"

            });$("#citys").select2({
                data: city,
                width:"140px"

            });
            $("#status").val("{{$showdata['datac']['status']}}").trigger("change");
            $("#provinces").val("{{$showdata['datac']['province_id']}}").trigger("change");
            $("#citys").val("{{$showdata['datac']['city_id']}}").trigger("change");


            //  加载所有的省份
//            $.ajax({
//                type: "get",
//                url: "/api/get_region", // type=1表示查询省份
//                data: {"parent_id": "1", "type": "1"},
//                dataType: "json",
//                success: function(data) {
//
//                    $("#provinces").html("<option value=''>请选择省份</option>");
//                    $.each(data['data'], function(i, item) {
//                        // alert(item.region_id);
//                        $("#provinces").append("<option value='" + item.linkageid + "'>" + item.name + "</option>");
//                    });
////                    $('#provinces').val('3').trigger('change');
//                }
//            });

            $('#provinces').change(function(){
                var firstValue = $(this).val();
//                if(firstValue == ''){
                $("#citys").html("<option value=''>请选择市</option>");
//                    $("#countys").html("<option value=''>请选择县</option>");
//                    return;
//                }
//                $("#citys").empty();
//                $("#countys").empty();
                $.ajax({
                    type: "get",
                    url: "/api/get_region", // type=2表示查询市
                    data: {"parent_id": firstValue, "type": "2"},
                    dataType: "json",
                    success: function(data) {

                        $("#citys").html("<option value=''>请选择市</option>");
                        $.each(data['data'], function(i, item) {
                            // alert(item.region_id);
                            $("#citys").append("<option value='" + item.linkageid + "'>" + item.name + "</option>");
                        });
//                        $('#citys').val('45').trigger('change');
                    }
                });
            });
            $('#citys').change(function(){
                var firstValue = $(this).val();

            });
            var hup = true;
            var prontv = null;
            $(".switch-bg").on('click',function(){
                hup = true;
                if(!prontv){
                    prontv = this.className;
                }
                    $(this).toggleClass('turn-off');


            }).on('transitionend',function(e){

                if(e.target === this) {

                    var that = this;
                    if(this.className == prontv){
                        return false;
                    }
                    prontv = null;
                    if($(this).hasClass('turn-off')){
                        var flag = 0;
                    }else{
                        var flag = 1;
                    }
                    if(hup){

                        $.post("/admin/latestpolicy/api_show/"+this.dataset.id,{'flag':flag,'_token':"{{csrf_token()}}"},function (data) {
                            if(data.statu==1){
                                console.log(data);
                            }else if(data.statu==4){
                                alert(data.msg);
                            }else{
                                alert(data.msg);
                                if($(that).hasClass("turn-off")){
                                    $(that).removeClass("turn-off");
                                    hup = !hup;
                                }else{

                                    $(that).addClass("turn-off");
                                    hup = !hup;
                                }
                            }
                        });
                    }

                }

            });

        });
    </script>
@endsection