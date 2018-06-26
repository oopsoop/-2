<?php
//Route::get('/', function () { return redirect('/admin/home'); });
//
//// Authentication Routes...
//$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
//$this->post('login', 'Auth\LoginController@login')->name('auth.login');
//$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');
//
//// Change Password Routes...
//$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
//$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');
//
//// Password Reset Routes...
//$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
//$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
//$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');
//
//Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
//    Route::get('/home', 'HomeController@index');
//    Route::resource('permissions', 'Admin\PermissionsController');
//    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
//    Route::resource('roles', 'Admin\RolesController');
//    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
//    Route::resource('users', 'Admin\UsersController');
//    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
//
//});

//Route::group(['prefix'=>'auth','middleware'=>'jwt.auth'],function($router){
//    $router->get('/home','AuthController@home');
//});

//mail


Route::get('/', function () { return redirect('/login'); });
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


Route::get('ee','EventController@index');
Route::group(['middleware' => 'auth'], function () {
    Route::get('actionLog', 'EventController@actionLog');
});
//
Route::group(['middleware' => ['auth:web'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
//Route::group(['middleware' => 'auth'], function () {

    Route::any('/prompt','Controller@prompt');

    Route::get('/home', 'HomeController@index');
    // 场地管理
    Route::get('stadiums/index', 'Admin\StadiumsController@index');
    Route::any('stadiums/create', 'Admin\StadiumsController@create');
    Route::any('stadiums/update/{id}','Admin\StadiumsController@update');
    Route::any('stadiums/destroy/{id}','Admin\StadiumsController@destroy');
    //生成二维码
    Route::any('stadiums/gqrcode/{id}','Admin\StadiumsController@gqrcode');



    // 课程管理
    Route::get('courses/index', 'Admin\CoursesController@index');
    Route::any('courses/create', 'Admin\CoursesController@create');
    Route::any('courses/update/{id}','Admin\CoursesController@update');
    Route::any('courses/destroy/{id}','Admin\CoursesController@destroy');
    // todo:查看课程表课时
    Route::get('courses/show_course/{id}','Admin\CoursesController@show_course');
    // todo:提交课程表课时
    Route::post('courses/show_course/{id}','Admin\CoursesController@show_course');


    // 教师管理
    Route::get('teachers/index', 'Admin\TeachersController@index');
    Route::any('teachers/create', 'Admin\TeachersController@create');
    Route::any('teachers/update/{id}','Admin\TeachersController@update');
    Route::any('teachers/destroy/{id}','Admin\TeachersController@destroy');
    Route::any('teachers/bind_wxuser/{id}','Admin\TeachersController@bind_wxuser');


    // 预约信息管理
    Route::get('bespokes/index', 'Admin\BespokesController@index');
    Route::any('bespokes/create', 'Admin\BespokesController@create');
    Route::any('bespokes/update/{id}','Admin\BespokesController@update');
    Route::any('bespokes/destroy/{id}','Admin\BespokesController@destroy');

    // 微信用户列表
    Route::get('wxusers/index', 'Admin\WxusersController@index');
    Route::any('wxusers/create', 'Admin\WxusersController@create');
    Route::any('wxusers/update/{id}','Admin\WxusersController@update');
    Route::any('wxusers/destroy/{id}','Admin\WxusersController@destroy');

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

    //3 pictures

    Route::get('pictures/index', 'Admin\PicturesController@index');
    Route::any('pictures/create', 'Admin\PicturesController@create');
    Route::any('pictures/update/{id}','Admin\PicturesController@update');
    Route::any('pictures/chakan/{id}','Admin\PicturesController@chakan');
//    Route::any('pictures/edit/{id}','Admin\PicturesController@edit');
    Route::any('pictures/destroy/{id}','Admin\PicturesController@destroy');


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

    Route::any('users/destroy/{id}','Admin\UsersController@destroy');

    Route::resource('users', 'Admin\UsersController');

    Route::post('users/destroy/{id}','Admin\UsersController@destroy');

    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

});

include_once ('home.php');
