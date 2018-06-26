<?php

//mail

Route::get('/', function () { return redirect('/dist'); });
Route::get('/admin/home', function () { return 2222222000; });
Route::get('/username', function () { return Auth::user()->name; });
Route::get('/uid', function () { return Auth::id(); });


// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');



// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');
//
//
//
//图片上传
Route::get('getHome', 'CropController@getHome');
Route::get('getHomexx', 'CropController@getHomexx');
Route::post('upload', 'CropController@postUpload');
Route::post('crop', 'CropController@postCrop');
Route::post('file_save','Controller@file_save');
Route::post('pic_upload','Controller@pic_upload');


Route::get('/cee',function(){ phpinfo();});
Route::group(['middleware' => 'auth'], function () {
    Route::get('actionLog', 'EventController@actionLog');
});
//
Route::group(['middleware' => ['auth:web'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
//Route::group(['middleware' => 'auth'], function () {

    Route::any('/prompt','Controller@prompt');

    Route::get('/home', 'HomeController@index');
    // 企业信息
    Route::get('enterprises/index', 'Admin\EnterPrisesController@index');
    Route::any('enterprises/create', 'Admin\EnterPrisesController@create');
    Route::any('enterprises/update/{id}','Admin\EnterPrisesController@update');
//    Route::any('enterprise/edit/{id}','Admin\EnterPrisesController@edit');
    Route::any('enterprises/destroy/{id}','Admin\EnterPrisesController@destroy');
//    Route::any('enterprise/del/{id}','Admin\EnterPrisesController@del');


    // 项目申报
    Route::get('projapplications/index', 'Admin\ProjapplicationsController@index');
    Route::any('projapplications/create', 'Admin\ProjapplicationsController@create');
    Route::any('projapplications/update/{id}','Admin\ProjapplicationsController@update');
//    Route::any('project_application/edit/{id}','Admin\EnterPrisesController@edit');
    Route::any('projapplications/destroy/{id}','Admin\ProjapplicationsController@destroy');
//    Route::any('enterprise/del/{id}','Admin\EnterPrisesController@del');

    // 知识产权申请
    Route::get('intellectproperties/index', 'Admin\IntellectpropertiesController@index');
    Route::any('intellectproperties/create', 'Admin\IntellectpropertiesController@create');
    Route::any('intellectproperties/update/{id}','Admin\IntellectpropertiesController@update');
//    Route::any('enterprise/edit/{id}','Admin\IntellectpropertiesController@edit');
    Route::any('intellectproperties/destroy/{id}','Admin\IntellectpropertiesController@destroy');
//    Route::any('enterprise/del/{id}','Admin\EnterPrisesController@del');

    //
    // 交易信息
//    Route::get('enterprise', 'Admin\EnterPrisesController@index');
//    Route::any('enterprise/create', 'Admin\EnterPrisesController@create');
//    Route::any('enterprise/update/{id}','Admin\EnterPrisesController@update');
////    Route::any('enterprise/edit/{id}','Admin\EnterPrisesController@edit');
//    Route::any('enterprise/destroy/{id}','Admin\EnterPrisesController@destroy');
//    Route::any('enterprise/archives','Admin\EnterPrisesController@archives');
//    Route::any('enterprise/del/{id}','Admin\EnterPrisesController@del');

    // 系统管理-latest policy
    Route::get('latestpolicy/index', 'Admin\LatestPolicyController@index');
    Route::any('latestpolicy/create', 'Admin\LatestPolicyController@create');
    Route::any('latestpolicy/update/{id}','Admin\LatestPolicyController@update');
    Route::any('latestpolicy/chakan/{id}','Admin\LatestPolicyController@chakan');
//    Route::any('latestpolicy/edit/{id}','Admin\LatestPolicyController@edit');
    Route::any('latestpolicy/destroy/{id}','Admin\LatestPolicyController@destroy');
    Route::any('latestpolicy/api_show/{id}','Admin\LatestPolicyController@api_show');

//    Route::any('enterprise/del/{id}','Admin\EnterPrisesController@del');


    //news
    Route::get('news/index', 'Admin\NewsController@index');
    Route::any('news/create', 'Admin\NewsController@create');
    Route::any('news/update/{id}','Admin\NewsController@update');
    Route::any('news/chakan/{id}','Admin\NewsController@chakan');
//    Route::any('news/edit/{id}','Admin\NewsController@edit');
    Route::any('news/destroy/{id}','Admin\NewsController@destroy');


    //轮播图
    Route::get('sowingmap/index', 'Admin\SowingMapController@index');
    Route::any('sowingmap/create', 'Admin\SowingMapController@create');
    Route::any('sowingmap/update/{id}','Admin\SowingMapController@update');
    Route::any('sowingmap/chakan/{id}','Admin\SowingMapController@chakan');
//    Route::any('sowingmap/edit/{id}','Admin\SowingMapController@edit');
    Route::any('sowingmap/destroy/{id}','Admin\SowingMapController@destroy');


    // 注册用户管理
    Route::get('registerpeople/index', 'Admin\RegisterPeopleController@index');
    Route::any('registerpeople/create', 'Admin\RegisterPeopleController@create');
    Route::any('registerpeople/update/{id}','Admin\RegisterPeopleController@update');
    Route::any('registerpeople/chakan/{id}','Admin\RegisterPeopleController@chakan');
//    Route::any('registerpeople/edit/{id}','Admin\RegisterPeopleController@edit');
    Route::any('registerpeople/destroy/{id?}','Admin\RegisterPeopleController@destroy');
//    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
//    Route::any('enterprise/del/{id}','Admin\EnterPrisesController@del');




    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);


//    Route::get('users/index','Admin\UsersController@index');

//    Route::get('users/index','Admin\UsersController@index');
    Route::resource('users', 'Admin\UsersController');

    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

});

include_once ('home.php');
