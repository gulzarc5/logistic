<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin'],function(){
    Route::get('/admin/login','LoginController@index')->name('admin.login_form');    
    Route::post('login', 'LoginController@adminLogin');
    Route::get('city/list/{state_id}' ,'ConfigurationController@cityListWithState')->name('admin.city_list_with_state');
 
    Route::group(['middleware'=>['auth','AdminUser'],'prefix'=>'admin'],function(){
        Route::get('/dashboard', 'DashboardController@dashboardView')->name('admin.deshboard');        
        Route::post('logout', 'LoginController@logout')->name('admin.logout');
        Route::get('/change/password/form', 'DashboardController@changePasswordForm')->name('admin.change_password_form');
        Route::post('/change/password', 'DashboardController@changePassword')->name('admin.change_password');

        Route::group(['prefix'=>'user'],function(){
            Route::get('add/form','UserController@addUserForm')->name('admin.add_user_form');
            Route::post('add','UserController@addUser')->name('admin.add_user');
            Route::get('list/','UserController@userList')->name('admin.userList');
            Route::get('list/ajax','UserController@userListAjax')->name('admin.userListAjax');
            Route::post('edit/{id}','UserController@editUser')->name('admin.edit_user');
            Route::get('details/{user_id}','UserController@userDetails')->name('admin.userDetails');
            Route::get('status/update/{user_id}/{status}','UserController@userStatus')->name('admin.userStatus');
        });

        Route::group(['prefix'=>'role'],function(){
            Route::get('add/form','RoleController@addRoleForm')->name('admin.add_role_form');
            Route::post('add','RoleController@addRole')->name('admin.add_role');
            Route::get('list/','RoleController@roleList')->name('admin.role_list');
            Route::get('edit/{id}','RoleController@editRole')->name('admin.edit_role');
            Route::put('update/{id}','RoleController@updateRole')->name('admin.update_role');
            Route::get('permission/{id}','RoleController@viewRolePermissions')->name('admin.view_role_permissions');
            // Route::get('status/update/{user_id}/{status}','UserController@userStatus')->name('admin.userStatus');
        });

        Route::group(['prefix'=>'configuration'],function(){
            Route::group(['prefix'=>'state'],function(){
                Route::get('add/form','ConfigurationController@addStateForm')->name('admin.add_state_form');
                Route::post('add','ConfigurationController@addState')->name('admin.add_state');

                Route::get('list','ConfigurationController@stateList')->name('admin.state_list');
                Route::get('status/{id}/{status}','ConfigurationController@stateStatus')->name('admin.state_status');
                Route::get('edit/{id}','ConfigurationController@stateEdit')->name('admin.state_edit');
                
                Route::put('update/{id}','ConfigurationController@stateUpdate')->name('admin.state_update');
            });

            Route::group(['prefix'=>'city'],function(){
                Route::get('add/form','ConfigurationController@addCityForm')->name('admin.add_city_form');
                Route::post('add','ConfigurationController@addCity')->name('admin.add_city');

                Route::get('list','ConfigurationController@cityList')->name('admin.city_list');
                Route::get('list/ajax','ConfigurationController@cityListAjax')->name('admin.city_list_ajax');
                Route::get('status/{id}/{status}','ConfigurationController@cityStatus')->name('admin.city_status');
                Route::get('edit/{id}','ConfigurationController@cityEdit')->name('admin.city_edit');
                
                Route::put('update/{id}','ConfigurationController@cityUpdate')->name('admin.city_update');
            });

            Route::group(['prefix'=>'service/area/'],function(){
                Route::get('add/form','ConfigurationController@addServiceAreaForm')->name('admin.add_service_area_form');
                Route::post('add','ConfigurationController@addServiceArea')->name('admin.add_service_area');

                Route::get('list','ConfigurationController@serviceAreaList')->name('admin.serviceArea_list');
                Route::get('list/ajax','ConfigurationController@serviceAreaListAjax')->name('admin.serviceArea_list_ajax');
                Route::get('status/{id}/{status}','ConfigurationController@serviceAreaStatus')->name('admin.serviceArea_status');
                Route::get('edit/{id}','ConfigurationController@serviceAreaEdit')->name('admin.serviceArea_edit');
                
                Route::put('update/{id}','ConfigurationController@serviceAreaUpdate')->name('admin.serviceArea_update');
            });
        });


        Route::group(['prefix'=>'cannote'],function(){
            Route::get('add/form','CannoteController@addForm')->name('admin.cannote_add_form');
            Route::post('add','CannoteController@addState')->name('admin.add_state');

            // Route::get('list','CannoteController@stateList')->name('admin.state_list');
            // Route::get('status/{id}/{status}','CannoteController@stateStatus')->name('admin.state_status');
            // Route::get('edit/{id}','CannoteController@stateEdit')->name('admin.state_edit');
            
            // Route::put('update/{id}','CannoteController@stateUpdate')->name('admin.state_update');
        });
    });
});