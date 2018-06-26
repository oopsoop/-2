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
            用户修改 / 编辑
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    <label for="name" class="control-label">姓名</label>
                    <input type="text" class="form-control" name="name" id="name"  placeholder="文章名称" value="@if(!empty(old('name'))){{old('name')}}@else{{$HomeUser['name']}}@endif">

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
                   <input type="text" class="form-control" name="email" id="email"  placeholder="排序" value="@if(!empty(old('email'))){{old('email')}}@else{{$HomeUser['email']}}@endif">

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
                    <input type="text" class="form-control" name="password" id="password"  placeholder="" value="">
                    <span style="color: #f00;">*不填表示不修改原密码</span>
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

@stop

