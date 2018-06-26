@extends('layouts.app')
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<style>
    input[type=checkbox], input[type=radio] {
        margin: 0px !important;

        position: relative !important;
        top: 2px !important;

    }
</style>
@section('content')
    <h3 class="page-title">角色</h3>
    {!! Form::open(['method' => 'POST','id'=>'XP', 'route' => ['admin.roles.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            添加
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name', '角色名称*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                {{--<div class="col-xs-12 form-group">--}}
                    {{--{!! Form::label('permission', '权限', ['class' => 'control-label']) !!}--}}
                    {{--{!! Form::select('permission[]', $permissions, old('permission'), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}--}}
                    {{--<p class="help-block"></p>--}}
                    {{--@if($errors->has('permission'))--}}
                        {{--<p class="help-block">--}}
                            {{--{{ $errors->first('permission') }}--}}
                        {{--</p>--}}
                    {{--@endif--}}
                {{--</div>--}}
            </div>
             <div class="row">
                <link rel="stylesheet" href="{{ url('adminlte/css') }}/dtree.css"/>
    <script src="{{ url('adminlte/js') }}/dtree.js"></script>
                <div class="col-xs-12 form-group">
                <div class="dtree">

	<p><a href="javascript:  d.closeAll();">展开</a> | <a href="javascript: d.openAll();">折叠</a></p>

	<script type="text/javascript">

        var myPermissionData ={!!$permissions!!};
        d = new dTree('d');
        d.add(0,-1,'权限列表');
        for(let item of myPermissionData){
            d.add(item['id'],item['pid'],'permission',item['id'],item['name']);
        }
        document.write(d);
        d.closeAll();

        //        d.add(2,1,'authority','0002','新建工作',true);
//        d.add(3,2,'authority','0003','人事 ');
//        d.add(4,2,'authority','0004','财务');
//        d.add(5,2,'authority','0005','客服');
//        d.add(15,3,'authority','0006','请假申请');
//        d.add(16,3,'authority','0007','出差申请');
//        d.add(17,3,'authority','0008','招聘申请');
//
//        // dTree实例属性以此为：  节点ID，父类ID，chechbox的名称，chechbox的值，chechbox的显示名称，chechbox是否被选中--默认是不选，chechbox是否可用：默认是可用，节点链接：默认是虚链接
//        d.add(6,0,'authority','0012','一级菜单2 ',true,false);
//        d.add(7,6,'authority','0013','二级菜单2 ',true,false);
//        d.add(8,7,'authority','0014','用户管理 ',true,false);
//        d.add(9,7,'authority','0015','用户组管理 ',true,false);
//
//
//        d.add(11,0,'authority','0016','一级菜单3 ');
//        d.add(12,11,'authority','0017','二级菜单3 ');
//        d.add(13,12,'authority','0018','用户管理 ');
//        d.add(14,12,'authority','0019','用户组管理 ');
//
//        document.write(d);
//        d.closeAll();
//        d.openAll();

	</script>
                    {{--<input type='button' name='bTest' value='test' onclick='test();'>--}}

                </div>
            </div>
            
        </div>
    </div>

    {{--{!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}--}}
        <input class="btn btn-danger" id="btnsave"  type="submit" value="保存" >
    {!! Form::close() !!}
@stop

@section('javascript')


    <script>

        $(function(){
            $(document).on('click','#btnsave',function(){

                var wechat = document.getElementById('XP');
                var count = 0;
                var obj = document.all.permission;
                if( $('#XP').find(":hidden[name='permission[]']").length){
                    $('#XP').find(":hidden[name='permission[]']").remove();
                }

                for(i=0;i<obj.length;i++){
                    if(obj[i].checked){
                        var   myh   =   document.createElement("input");
                        myh.type   =   "hidden";
                        myh.value   =   obj[i].value;
                        myh.name   =   "permission[]";
                        //                    myh.id   =   "myh1";
                        wechat.appendChild(myh);

                        count ++;
                    }
                }
            });
        });


//
//       function test(){
//           var count = 0;
//           var obj = document.all.permission;
//
//           for(i=0;i<obj.length;i++){
//               if(obj[i].checked){
//                   alert(obj[i].value);
//                   count ++;
//               }
//           }
//       }
//

    </script>

@endsection

