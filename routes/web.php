<?php

Route::group(['namespace' => 'Admin','middleware'=>['auth:web','checkAdmin'],'prefix' => 'admin'],function (){
    //Dashboard
    Route::get('/','adminController@index')->name('dashboard');
    //settings
    Route::group(['middleware'=>['can:settings_manager']],function (){
        Route::get('settings','adminController@settings');
        Route::post('saveGeneralSettings','adminController@saveGeneralSettings');
    });
    //category manager
    Route::group(['middleware'=>['can:category_manager']],function () {
        Route::resource('category', 'CategoryController')->except('show');
        Route::post('category/sorting', 'CategoryController@sort');
        Route::post('category/refreshCategoryStatus', 'CategoryController@refreshStatus');
        Route::post('category/bulkRemove', 'CategoryController@categoryBulkRemove');
    });
    //file manager
    Route::get('fileManager','fileManagerController@index')->middleware('can:file_manager');
    //gallery manager
    Route::group(['middleware'=>['can:gallery_manager']],function () {
        Route::post('gallery/uploadImages/{id}', 'GalleryController@uploadImage')->name('uploadImage');
        Route::resource('gallery', 'GalleryController')->except('show');
        Route::post('gallery/refreshGalleryStatus', 'GalleryController@refreshStatus');
        Route::get('gallery/{id}/addGalleryImages', 'GalleryController@addGalleryImages');
        Route::post('gallery/removeImage', 'GalleryController@removeImage');
        Route::post('gallery/bulkRemove', 'GalleryController@galleryBulkRemove');
    });
    //menu manager
    Route::group(['middleware'=>['can:menu_manager']],function () {
        Route::resource('menu', 'MenuController')->except('show');
        Route::post('/menu/sorting', 'MenuController@sort');
        Route::post('menu/refreshMenuStatus', 'MenuController@refreshStatus');
    });
    //content manager
    Route::group(['middleware'=>['can:content_manager']],function () {
        Route::resource('content', 'ContentController')->except('show');
        Route::post('content/bulkRemove', 'ContentController@contentBulkRemove');
    });
    //message manager
    Route::group(['middleware'=>['can:message_manager']],function () {
        Route::get('message/search', 'MessageController@search');
        Route::resource('message', 'MessageController');
        Route::post('message/bulkRemove', 'MessageController@messageBulkRemove');
        Route::post('message/ReplyMessage', 'MessageController@replyMessage');
    });
    //users
    Route::resource('users','userController');
    //roles
    Route::resource('roles','roleController');
    //permissions
    Route::resource('permissions','permissionController');

});


Route::group(['namespace' => 'Auth'] , function (){
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');

//    // Email Verification Routes...
//    Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
//    Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
//    Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');

});

//contact us form
Route::post('postContact', 'siteController@postContact');

//render content pages
Route::get('/{name?}', 'siteController@renderPage');
