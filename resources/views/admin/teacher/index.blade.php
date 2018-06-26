@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">{{$showdata['page-title']}}</h3>
    <p>
        <a href="{{ url('admin/teachers/create') }}" class="btn btn-success">{{$showdata['app_add_new']}}</a>
    </p>
    <form id="" action="/admin/teachers/index" method="get" class="form-inline">

        {{--<div class="form-group">--}}
        {{--<label>状态：</label>--}}
        {{--<select name="status" id="status" class="form-control input-sm js-example-basic-single-status">--}}
        {{--</select>--}}
        {{--</div>--}}

       {{--<div class="form-group" style="margin-left:5px;">--}}
         {{--<label>开始日期：</label>--}}
         {{--<input type="text" class="input-sm form-control" name="kstime" id="kstime" placeholder="开始日期" value="@if($showdata['datac']['kstime'] != '1970-01-01 00:00:00'){{$showdata['datac']['kstime']}}@endif">--}}
       {{--</div>--}}
       {{--<div class="form-group" style="margin-left:5px;">--}}
         {{--<label>结束日期：</label>--}}
         {{--<input type="text" class="input-sm form-control" name="jstime" id="jstime" placeholder="结束日期" value="@if($showdata['datac']['jstime'] != '2100-12-30 23:59:59'){{$showdata['datac']['jstime']}}@endif">--}}
       {{--</div>--}}




        {{--<div class="form-group">--}}
            {{--<input type="hidden" name="pageno" id="pageno_change" value="{{$showdata['datac']['pageno']}}">--}}
            {{--<button class="btn btn-sm btn-default" type="submit" >查询</button>--}}
        {{--</div>--}}

</form>
    <div class="panel panel-default">
        <div class="panel-heading">
            列表
        </div>

        <div class="panel-body table-responsive">
            <table id="table" class="table table-striped b-t b-light" style="font-size:12px;">
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>教师名称</th>
                        <th>教师账号</th>
                        <th>联系电话</th>
                        <th>微信昵称</th>
                        <th>今日完成课程数</th>
                        <th>操作</th>
                    </tr>
                </thead>

                <tbody>
                    @if ($showdata['data']->count() > 0)
                        @foreach ($showdata['data'] as $proj)
                            <tr>
                                <td>{{ $proj->id }}</td>
                                <td>{{ $proj->name }}</td>
                                <td>{{ $proj->account }}</td>
                                <td>{{ $proj->mobile }}</td>
                                <td>{{ getNickName($proj->wechat,$proj->nickName) }}</td>
                                <td>{{ $proj->plancourse }}</td>

        <td>
            <a href="#" class="up">上移</a> <a href="#" class="down">下移</a> <a href="#" class="top">置顶</a>

            <a href="{{ url('admin/teachers/update',[$proj->id]) }}" _class="btn btn-xs btn-info"><i class="fa fa-pencil text-success text" style="font-size: 15px;"></i>{{$showdata['app_edit']}}</a>
            <a href="javascript:;" onclick="del({{$proj->id}})"  _class="btn btn-xs btn-info"><i class="fa fa-times text-danger text" style="font-size: 15px;"></i>删除</a>

            {{--<a href="{{ url('admin/teachers/show_course',[$proj->id]) }}" _class="btn btn-xs btn-info"><i class="fa fa-pencil text-success text" style="font-size: 15px;"></i>课程详情</a>--}}
{{--            <a href="{{ url('admin/teachers/bind_wxuser',[$proj->id]) }}" _class="btn btn-xs btn-info"><i class="fa fa-pencil text-success text" style="font-size: 15px;"></i>微信帐号绑定</a>--}}

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
    <script src="https://cdn.bootcss.com/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
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
    {{--<!-- 日历开始 -->--}}
    {{--<link href="{{ url('adminlte/css') }}/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">--}}
    {{--<script type="text/javascript" src="{{ url('adminlte/js') }}/bootstrap-datetimepicker.js" charset="UTF-8"></script>--}}
    {{--<script type="text/javascript" src="{{ url('adminlte/js') }}/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>--}}
    {{--<script type="text/javascript">--}}
    {{--// 日历选择--}}
    {{--$('#kstime').datetimepicker({--}}
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
    {{--$('#jstime').datetimepicker({--}}
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

    <!-- 日历结束 -->

    <script>
          function del(id) {
              layer.confirm('您确定要删除吗？', {
                  btn: ['确定','取消'] //按钮
              }, function(){
                  $.post("/admin/teachers/destroy/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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
           $('.divOne').each(function (i,k) {
               $(this).qrcode({width: 64,height: 64,text: this.dataset.url});
//               var qrcode= $(this).qrcode(this.dataset.url);
//               var canvas=qrcode.find('canvas').get(0);
//               $(this).find('img').attr('src',canvas.toDataURL('image/jpg'));
//               canvas.style.display='none';
           });


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

            {{--var my_status_data = {!! $showdata['status_t'] !!};--}}

            {{--$("#status").select2({--}}
                {{--data: my_status_data,--}}
                {{--width:"140px"--}}

            {{--});--}}
            {{--$("#status").val("{{$showdata['datac']['status']}}").trigger("change");--}}




        });
    </script>
@endsection