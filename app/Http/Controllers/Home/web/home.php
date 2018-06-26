<?php
/**
 * Created by PhpStorm.
 * User: 28428
 * Date: 2018/04/27
 * Time: 13:30
 */

Route::group(['prefix'=>'api'],function(){

    //验证码
    Route::get('/validate_code/create','Home\ValidateController@create');
    Route::get('/validate_code/get_uid','Home\ValidateController@get_uid');

    Route::get('/index','Home\LoginController@index');
    Route::any('/login', "Home\LoginController@login")->name('login');
    Route::get('/register', "Home\RegisterController@register");
    Route::post('/register', "Home\RegisterController@register");

    Route::get('/getCookies', "Home\LoginController@getCookies");
    //发送验证码
    Route::any('/send_sms/{flag?}', "Home\SmsController@send");
    //检查验证码
    Route::any('/checkSMSCode', "Home\SmsController@checkSMSCode");
    //重置密码
    Route::any('/reset_password', "Home\SmsController@resetPwd");
    // global region
    Route::any('/getRegionList', "Home\GlobalRegionController@getRegionList");

    Route::get('/testRedis','Home\RedisController@testRedis')->name('testRedis');

    Route::any('/logout',function () {
//        dd(session('usermobile'));
        return (new \App\HomeUser)->logout();

    });
    Route::get('/is_loggin',function () {
        return (new \App\HomeUser)->is_logged_in();
    });

    Route::get('/my_identity',function () {
        return (new \App\HomeUser)->my_info();
    });

    //基础档案
    Route::get('/basic_dossier_get',"Home\BasicDossierController@get");
    Route::post('/basic_dossier_add',"Home\BasicDossierController@add");
    Route::any('/basic_dossier_update/{enterprise_id?}',"Home\BasicDossierController@edit");
    //证件档案
    Route::get('/credential_dossier_get',"Home\BasicDossierController@cred_get");
    Route::get('/credential_dossier_getFileupload',"Home\BasicDossierController@getFileupload");
    Route::any('/credential_dossier_add',"Home\BasicDossierController@cred_add");
    Route::any('/credential_dossier_del',"Home\BasicDossierController@cred_del");
//    Route::any('/credential_dossier_update/{enterprise_id?}',"Home\BasicDossierController@edit");
    //人员档案
    Route::get('/personal_dossier_get',"Home\PersonalDossierController@get");
    Route::any('/personal_dossier_add',"Home\PersonalDossierController@add");
    Route::any('/personal_dossier_update/{personal_id?}',"Home\PersonalDossierController@edit");

    //文件上传
    Route::any('/upload_pic/{field_name?}','Home\SmsController@upload_pic');
    //知识档案申请
    Route::get('/intellectual_dossier_get',"Home\IntellectpropertyController@get");
    Route::any('/intellectual_dossier_add',"Home\IntellectpropertyController@intell_add");
    //项目档案申请
    Route::any('/proj_dossier_add',"Home\ProjapplicationsController@proj_step1");
    //文件删除
    Route::any('/del_pic','Home\SmsController@del_pic');
    //

    Route::get('/get_region','Home\SmsController@get_region');

    //get category
    Route::get('/get_category','Home\SmsController@get_category');

    //获取进度

    Route::any('/get_step','Home\ProjapplicationsController@get_step');
    Route::get('/getOwnDetail','Home\ProjapplicationsController@getOwnDetail');

//    Route::get('/sdsds',function(){
//        return \App\Intellectual::where('qiye_id','35')->first();
//    });
    //最新政策首页接口
    Route::any('/policyHomePage','Home\PolicyController@policyHomePage');
    Route::any('/getPolicyById','Home\PolicyController@getPolicyById');
    Route::any('/getColumn','Home\PolicyController@getColumn');

    // 获取新闻接口
    Route::any('/newsHomePage','Home\NewsController@newsHomePage');
    Route::any('/getNewsById','Home\NewsController@getNewsById');
    Route::any('/vpn',function(){
        return 'vpn';
    });
    // 轮播图
 Route::any('/sowingmap','Home\SowingMapController@show');

//  Route::group(['middleware'=>'auth:home'],function (){
//        Route::get('/test',function (){
//            dd(session('abc'));
//            session(['abc'=>'laravel学院']);
//            session(['def'=>'hhkks']);
//            session()->put('A.B.C','123');
//            session()->pull('A');
//            session()->forget('def');
//            dd(session()->has('def'));
//            dd(session('abc','def'));
//            dd(session()->all());
//            Cache::put('key1', 'value1', 1);
//            dd(Cache::get('key1'));
//            if(Auth::check()){
//                Cache::put('key1', 'value1', 1);
//            }

//            return Auth::user();
//        });
//    });


});
