@extends('layouts.app')

@section('content')
    <h3 class="page-title">{{$showdata['page-title']}}</h3>

    <form action = "{{url()->current()}}" id="myform" method="post">
       <input type="hidden" name="is" value="1">

        {{csrf_field()}}
        <div id="box">
            <div id="head_list">
                {{--<input type="button" value="用户修改"  class="active"/>--}}
                {{--<input type="button" value="企业证件" />--}}
                {{--<input type="button" value="档案信息" />--}}
            </div>
       <div id="menu_content">
       <div class="panel panel-default is_show level" >
        <div class="panel-heading">
            用户添加
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="name" class="control-label">姓名</label>
                    <input type="text" class="form-control" name="name" id="name"  placeholder="" value="{{ old('name') }}">

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
                    <label for="email" class="control-label">邮箱</label>
                    <input type="text" class="form-control" name="email" id="email"  placeholder="" value="{{ old('email') }}">

                   <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="password" class="control-label">密码</label>
                    <input type="text" class="form-control" name="password" id="password"  placeholder="" value="{{ old('password') }}">

                   <p class="help-block"></p>
                    @if($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
            </div>
        </div>
       </div>
       </div>
             </div>
           <input class="btn btn-danger" __onclick="hook();" type="submit" value="保存">
        </div>
        </div>
    </form>

    {{--{!! Form::open(['method' => 'POST', 'route' => ['admin.users.store']]) !!}--}}

    {{--<div class="panel panel-default">--}}
        {{--<div class="panel-heading">--}}
           {{--{{$showdata['app-create']}}--}}
        {{--</div>--}}
        {{----}}
        {{--<div class="panel-body">--}}
            {{--<div class="row">--}}
                {{--<div class="col-xs-12 form-group">--}}
                    {{--{!! Form::label('name', '姓名*', ['class' => 'control-label']) !!}--}}
                    {{--{!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}--}}
                    {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('name'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('name') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col-xs-12 form-group">--}}
                    {{--{!! Form::label('email', '邮箱*', ['class' => 'control-label']) !!}--}}
                    {{--{!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}--}}
                    {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('email'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('email') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row">--}}
                {{--<div class="col-xs-12 form-group">--}}
                    {{--{!! Form::label('password', '密码*', ['class' => 'control-label']) !!}--}}
                    {{--{!! Form::password('password', ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}--}}
                    {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('password'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('password') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}

        {{--</div>--}}
    {{--</div>--}}

    {{--{!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}--}}
    {{--{!! Form::close() !!}--}}
@stop

