<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
            Route::get('add/form','DocateController@addForm')->name('branch.docate_add_form');
            Route::post('add','DocateController@addDocate')->name('branch.add_docate');
            Route::get('city/list/{state_id}','DocateController@cityList')->name('branch.city_list');
        });


        Route::group(['prefix'=>'manifest'],function(){
            Route::get('list/','ManifestController@manifestList')->name('branch.manifest_list');
            Route::get('docate/{origin}/{destination}','ManifestController@fetchDocate')->name('branch.fetch_docate');
            Route::get('fetch/docate/details/{docate_no}/{origin}/{destination}','ManifestController@fetchDocateDetails')->name('branch.fetch_docate_details');
            Route::post('add/no','ManifestController@addManifestNo')->name('branch.add_manifest_no');
            
        });


        Route::group(['prefix'=>'baging'],function(){
            Route::get('list/','BagingController@bagingList')->name('branch.baging_list');
            Route::get('add/form/{manifest_no}','BagingController@fetchAddForm')->name('branch.fetch_baging_add_form');
            Route::post('add/no','BagingController@addBagingNo')->name('branch.add_baging_no');
        });

        Route::group(['prefix'=>'sectorbooking'],function(){
            Route::get('list/','SectorBookingController@sectorBookingList')->name('branch.sector_booking_list');
            Route::get('add/form/{manifest_no}','SectorBookingController@fetchAddForm')->name('branch.fetch_baging_add_form');
            Route::post('add/no','SectorBookingController@sectorBook')->name('branch.sector_book');

        });

        Route::group(['prefix'=>'report'],function(){
            Route::get('form','ReportController@reportForm')->name('branch.report_form');
            Route::post('fetch/all/entries','ReportController@fetchAllEntries')->name('branch.fetch_all_entries');
           
        });

        Route::group(['prefix'=>'inquiry'],function(){
            Route::get('form','InquiryController@showInquiryForm')->name('branch.inquiry_form');
            Route::get('fetch/docate/{docate_id}','InquiryController@fetchDocate')->name('branch.fetch_docate');
            Route::get('details/form','InquiryController@detailsForm')->name('branch.details_form');
            Route::get('get/details','InquiryController@getDetails')->name('branch.get_details');
            // Route::get('get/baging/details/{docate_id}','InquiryController@retriveBagingDetails')->name('branch.retrive_baging_details');
            // Route::get('sector/booking/details/{docate_id}','InquiryController@sectorDetails')->name('branch.retrive_sector_details');
        });
    });
});