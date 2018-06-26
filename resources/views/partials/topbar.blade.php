<style>
    .skin-blue .main-header .logo{
        background-color: rgb(60,141,188);


    }
    .skin-blue .main-header .logo img{
        height :45px;
    }
    .skin-blue .main-header .logo:hover{
        background-color: rgb(60,141,188);
    }
</style>
<header class="main-header">
    <!-- Logo -->
    {{--<a href="{{ url('/admin/home') }}" class="logo"  style="font-size: 16px;">--}}
    <a class="logo"  style="font-size: 16px;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
            电影学院管理系统
           {{--<img src = "{{ url('adminlte/img/logo.png') }}" />--}}

        </span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
            电影学院管理系统
            {{--<img src = "{{ url('adminlte/img/logo.png') }}" />--}}
        </span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a  class="sidebar-toggle" data-toggle="offcanvas" role="button">
            {{--易企申后台管理系统--}}
            {{--<span class="sr-only">Toggle navigation</span>--}}
            {{--<span class="icon-bar"></span>--}}
            {{--<span class="icon-bar"></span>--}}
            {{--<span class="icon-bar"></span>--}}
        </a>
    </nav>
</header>


