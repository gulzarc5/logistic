<?php

use Illuminate\Http\Request;

Route::group(['namespace' => 'Branch'],function(){
    Route::get('/branch','LoginController@index')->name('branch.login_form');    
    Route::post('branch/login', 'LoginController@branchLogin');
 
    Route::group(['middleware'=>['auth','BranchUser'],'prefix'=>'branch'],function(){
        Route::get('/dashboard', 'DashboardController@dashboardView')->name('branch.deshboard');        
        Route::post('logout', 'LoginController@logout')->name('branch.logout');
        Route::get('/change/password/form', 'DashboardController@changePasswordForm')->name('branch.change_password_form');
        Route::post('/change/password', 'DashboardController@changePassword')->name('branch.change_password');

        Route::group(['prefix'=>'role'],function(){
            Route::get('add/form','RoleController@addRoleForm')->name('branch.add_role_form');
            Route::post('add','RoleController@addRole')->name('branch.add_role');
            Route::get('list/','RoleController@roleList')->name('branch.role_list');
            Route::get('edit/{id}','RoleController@editRole')->name('branch.edit_role');
            Route::put('update/{id}','RoleController@updateRole')->name('branch.update_role');
            Route::get('permission/{id}','RoleController@viewRolePermissions')->name('branch.view_role_permissions');
            // Route::get('status/update/{user_id}/{status}','UserController@userStatus')->name('branch.userStatus');
        });


        Route::group(['prefix'=>'user'],function(){
            Route::get('add/form','UserController@addUserForm')->name('branch.add_user_form');
            Route::post('add','UserController@addUser')->name('branch.add_user');
            Route::get('list/','UserController@userList')->name('branch.userList');
            Route::get('list/ajax','UserController@userListAjax')->name('branch.userListAjax');
            Route::post('edit/{id}','UserController@editUser')->name('branch.edit_user');
            Route::get('details/{user_id}','UserController@userDetails')->name('branch.userDetails');
            Route::get('status/update/{user_id}/{status}','UserController@userStatus')->name('branch.userStatus');
        });
        Route::group(['prefix'=>'docate'],function(){
            Route::get('add/form','DocateController@addForm')->name('admin.docate_add_form');
        });

    });
});