@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                    <span class="title">数据统计</span>
                </a>
            </li>

            <?php $btns = showBtns(); foreach($btns as $k=>$v):  $jshash=1; ?>
            <li class="treeview" >
                <a>
                    <i class="fa fa-users"></i>
                    <span class="title">
                        {{--@lang('global.user-management.title')--}}
                        <?php echo $v['name']; ?>
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <?php if(!empty($v['children'])): ?>
                <ul class="treeview-menu">
                    <?php foreach ($v['children'] as $k1 => $v1):
                       $jshash++;
                    ?>
                    {{--{{ $request->segment(2) }}--}}

                    <li data-sds="{{$request->segment(2)}}" class="<?php echo $request->segment(2) ==  strtolower($v1["controller_name"])  ? 'active-sub active ' : '' ?>">
                        <a href="<?php echo  '/admin/'.strtolower($v1['controller_name']).'/'.$v1['action_name']; ?>">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                               <?php echo $v1['name']; ?>
                            </span>
                        </a>
                    </li>
                    <?php endforeach; ?>

                </ul>
                <?php endif; ?>
            </li>
                <?php endforeach; ?>
            {{--@endcan--}}

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">修改密码</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">

                    <i class="fa fa-arrow-left"></i>
                    <span class="title">退出登录</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('global.logout')</button>
{!! Form::close() !!}

@section('javascript')

    {{--<script>--}}
        {{--$(function(){--}}
            {{--alert(555);--}}
            {{--$('.treeview').on('click',function(){--}}
                {{--alert(66);--}}
                {{--alert($(this).find('.active-sub').length);--}}
            {{--});--}}
        {{--});--}}

    {{--</script>--}}

@endsection