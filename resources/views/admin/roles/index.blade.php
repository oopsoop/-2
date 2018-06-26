@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">角色</h3>
    <p>
        <a href="{{ route('admin.roles.create') }}" class="btn btn-success">新增</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            列表
        </div>

        <div class="panel-body table-responsive">
            <table _class="table table-bordered table-striped {{ count($roles) > 0 ? 'datatable' : '' }} dt-select"  class="table table-striped b-t b-light" style="font-size:12px;">
                <thead>
                    <tr>
                        {{--<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>--}}

                        <th>角色名称</th>
                        <th>权限名称</th>

                        <th>操作</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($roles) > 0)
                        @foreach ($roles as $role)
                            <tr data-entry-id="{{ $role->id }}">

                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions()->pluck('name') as $permission)
                                        <span class="label label-info label-many">{{ $permission }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('admin.roles.edit',[$role->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.roles.destroy', $role->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('admin.roles.mass_destroy') }}';
    </script>
@endsection