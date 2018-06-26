@extends('layouts.app')

@section('content')
    <h3 class="page-title">权限</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.permissions.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            添加
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                     <label for="pid" class="control-label">上级权限：</label>
                   <select name = "pid" id = "">
                       <option value="0">顶级权限</option>
                       @foreach ($permissions as  $v)
                               <option value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
                       @endforeach;
                   </select>
                   <p class="help-block"></p>
                    @if($errors->has('intellectual_name'))
                        <p class="help-block">
                            {{ $errors->first('intellectual_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', '权限名称*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('controller_name', '控制器名称', ['class' => 'control-label']) !!}
                    {!! Form::text('controller_name', old('controller_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('controller_name'))
                        <p class="help-block">
                            {{ $errors->first('controller_name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('action_name', '方法名称', ['class' => 'control-label']) !!}
                    {!! Form::text('action_name', old('action_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('action_name'))
                        <p class="help-block">
                            {{ $errors->first('action_name') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

