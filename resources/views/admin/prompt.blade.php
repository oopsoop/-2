@extends('layouts.app')
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdn.bootcss.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Ionicons -->
    <link href="https://cdn.bootcss.com/ionicons/4.0.0-19/css/ionicons.min.css" rel="stylesheet">
    <!-- Theme style -->
    <link href="https://cdn.bootcss.com/admin-lte/2.4.3/css/AdminLTE.min.css" rel="stylesheet">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="https://cdn.bootcss.com/admin-lte/2.4.3/css/skins/_all-skins.min.css" rel="stylesheet">
    <style>
        .color-palette {
            height: 35px;
            line-height: 35px;
            text-align: center;
        }
        .color-palette-set {
            margin-bottom: 15px;
        }
        .color-palette span {
            display: none;
            font-size: 12px;
        }
        .color-palette:hover span {
            display: block;
        }
        .color-palette-box h4 {
            position: absolute;
            top: 100%;
            left: 25px;
            margin-top: -40px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 12px;
            display: block;
            z-index: 7;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="/bootstrap/js/html5shiv.min.js"></script>
    <script src="/bootstrap/js/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    {{--<link rel="stylesheet" href="/bootstrap/css/googlefonts.css">--}}
@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="panel panel-default">

               <div class="panel-body">
       <div style="margin:auto; width: 50%; height: auto; overflow: hidden;">
    <div class="box box-default" style="margin-top: 20%;">
        <div class="box-header with-border">
            <i class="fa fa-bullhorn"></i>
            <h3 class="box-title">提示</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if ($data['status']=='error')
                <div class="callout callout-danger">
                <h4>错误</h4>
                <p>{{$data['message']}}</p>
                <p>浏览器页面将在<b id="loginTime_error">{{ $data['jumpTime'] }}</b>秒后跳转......<a href="javascript:void(0);" class="jump_now">立即跳转</a> </p>
            </div>
            @endif
            @if ($data['status']=='continue')
                <div class="callout callout-info">
                <h4>未完成，继续</h4>
                <p>{{$data['message']}}</p>
                <p>浏览器页面将在<b id="loginTime_continue">{{ $data['jumpTime'] }}</b>秒后跳转......<a href="javascript:void(0);" class="jump_now">立即跳转</a> </p>
            </div>
            @endif
            @if ($data['status']=='warning')
                <div class="callout callout-warning">
                <h4>警告</h4>
                <p>{{$data['message']}}</p>
                <p>浏览器页面将在<b id="loginTime_warning">{{ $data['jumpTime'] }}</b>秒后跳转......<a href="javascript:void(0);" class="jump_now">立即跳转</a> </p>
            </div>
            @endif
            @if ($data['status']=='success')
                <div class="callout callout-success">
                <h4>成功</h4>
                <p>{{$data['message']}}</p>
                <p>浏览器页面将在<b id="loginTime_success">{{ $data['jumpTime'] }}</b>秒后跳转......<a href="javascript:void(0);" class="jump_now">立即跳转</a> </p>
            </div>
            @endif
        </div>
        <!-- /.box-body -->
    </div>
           <!-- /.box -->
</div>
                   </body>
                   </html>
                   <!-- jQuery 3 -->
<script src="https://cdn.bootcss.com/jquery/3.0.0/jquery.min.js"></script>
                   <!--本页JS-->
<script type="text/javascript">
    $(function(){
        //循环倒计时，并跳转
        var url = "{{ $data['url'] }}";
        var loginTimeID='loginTime_'+'{{$data['status']}}';
        //alert(loginTimeID);return;
        var loginTime = parseInt($('#'+loginTimeID).text());
        console.log(loginTime);
        var time = setInterval(function(){
            loginTime = loginTime-1;
            $('#'+loginTimeID).text(loginTime);
            if(loginTime==0){
                clearInterval(time);
                window.location.href=url;
            }
        },1000);
    });
    //点击跳转
    $('.jump_now').click(function () {
        var url = "{{ $data['url'] }}";
        window.location.href=url;
    });
</script>
            </div>
        </div>
    </div>
@endsection