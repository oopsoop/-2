@inject('request', 'Illuminate\Http\Request')
<style>
    .panel-body {
         padding: 0px !important;
    }
    table.dataTable tbody th, table.dataTable tbody td {
        padding: 8px 10px !important;

    }
    .table-striped>tbody>tr{
        height :30px !important;
        line-height :30px !important;
    }
    table.dataTable tbody th, table.dataTable tbody tr{
        height :30px !important;
        line-height :30px !important;
    }
</style>
@extends('layouts.app')

@section('content')
    <h3 class="page-title">{{$showdata['page-title']}}</h3>
    <p>
        <a href="{{ url('admin/registerpeople/create') }}" class="btn btn-success">{{$showdata['app_add_new']}}</a>
    </p>
    <form id="" action="/admin/registerpeople/index" method="get" class="form-inline">

        <div class="form-group">
        <label>用户名：</label>
        <input type = "text" name="name" id="name" value="@if($showdata['datac']['name'] != ''){{$showdata['datac']['name']}}@endif">

        </div>

        {{--<div class="form-group" style="margin-left:5px;">--}}
         {{--<label>开始日期：</label>--}}
         {{--<input type="text" class="input-sm form-control" name="kstime" id="kstime" placeholder="开始日期" value="@if($showdata['datac']['kstime'] != '1970-01-01 00:00:00'){{$showdata['datac']['kstime']}}@endif">--}}
       {{--</div>--}}
       {{--<div class="form-group" style="margin-left:5px;">--}}
         {{--<label>结束日期：</label>--}}
         {{--<input type="text" class="input-sm form-control" name="jstime" id="jstime" placeholder="结束日期" value="@if($showdata['datac']['jstime'] != '2100-12-30 23:59:59'){{$showdata['datac']['jstime']}}@endif">--}}
       {{--</div>--}}





        <div class="form-group">
            <input type="hidden" name="pageno" id="pageno_change" value="{{$showdata['datac']['pageno']}}">
            <button class="btn btn-sm btn-default" type="submit" >查询</button>
        </div>

</form>
    <div class="panel panel-default">
        <div class="panel-heading">
            {{$showdata['app_list']}}
        </div>

        <div class="panel-body table-responsive">
            <table _class="table table-bordered table-striped {{ $showdata['data']->count() > 0 ? 'datatable' : '' }} dt-select" class="table table-striped b-t b-light" style="font-size:12px;">
                <thead>
                    <tr>
                        {{--<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>--}}

                        <th>用户名</th>
                        <th>手机号</th>
                        <th>企业</th>
                        {{--<th>角色</th>--}}
                        <th>&nbsp;</th>

                    </tr>
                </thead>

                <tbody>
                    @if ($showdata['data']->count() > 0)
                        @foreach ($showdata['data'] as $user)
                            <tr data-entry-id="{{ $user->id }}">
                                {{--<td></td>--}}

                                <td><?php echo $user->name ?></td>
                                <td><?php echo $user->mobile ?></td>
                                {{--<td></td>--}}
                                <td><?php echo $user->enterprise['enterprise_name'] ?></td>
                                {{--<td>--}}
                                    {{--@foreach ($user->roles()->pluck('name') as $role)--}}
                                        {{--<span class="label label-info label-many">{{ $role }}</span>--}}
                                    {{--@endforeach--}}
                                {{--</td>--}}
                                <td>

                                     <a href="{{ url('admin/registerpeople/update',[$user->id]) }}" _class="btn btn-xs btn-info"><i class="fa fa-pencil text-success text" style="font-size: 15px;"></i>@lang('global.app_edit')</a>
                                     <a href="javascript:;" onclick="del({{$user->id}})"  _class="btn btn-xs btn-info"><i class="fa fa-times text-danger text" style="font-size: 15px;"></i>删除</a>
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
    <script>
          function del(id) {
              layer.confirm('您确定要删除吗？', {
                  btn: ['确定','取消'] //按钮
              }, function(){
                  $.post("/admin/registerpeople/destroy/"+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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
        {{--window.route_mass_crud_entries_destroy = '{{ route('admin.registerpeople.mass_destroy') }}';--}}
    </script>
@endsection