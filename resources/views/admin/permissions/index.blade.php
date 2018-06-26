@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">权限</h3>
    <p>
        <a href="{{ route('admin.permissions.create') }}" class="btn btn-success">新增</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            列表
        </div>

        <div class="panel-body table-responsive">
            <table _class="table table-bordered table-striped {{ count($permissions) > 0 ? 'datatable' : '' }} dt-select"  class="table table-striped b-t b-light" style="font-size:12px;">
                <thead>
                    <tr>
                        {{--<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>--}}

                        <th>权限名称</th>
                        <th>控制器名称</th>
                        <th>方法名称</th>
                        <th>上级权限id</th>
                        <th>操作</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($permissions) > 0)
                        @foreach ($permissions as $permission)
                            <tr data-entry-id="{{ $permission->id }}">

                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->controller_name }}</td>
                                <td>{{ $permission->action_name }}</td>
                                <td>{{ $permission->pid }}</td>
                                <td>
                                    <a href="{{ route('admin.permissions.edit',[$permission->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.permissions.destroy', $permission->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('admin.permissions.mass_destroy') }}';
    </script>
@endsection