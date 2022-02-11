<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['namespace' => 'Admin'],function(){
    Route::get('/admin/login','LoginController@index')->name('admin.login_form');    
    Route::post('login', 'LoginController@adminLogin');
    Route::get('city/list/{state_id}' ,'ConfigurationController@cityListWithState')->name('admin.city_list_with_state');
 
    Route::group(['middleware'=>['role:Admin'],'prefix'=>'admin'],function(){
        Route::get('/dashboard', 'DashboardController@dashboardView')->name('admin.deshboard');        
        Route::post('logout', 'LoginController@logout')->name('admin.logout');
        Route::get('/change/password/form', 'DashboardController@changePasswordForm')->name('admin.change_password_form');
        Route::post('/change/password', 'DashboardController@changePassword')->name('admin.change_password');

        Route::group(['prefix'=>'user'],function(){
            Route::get('add/form','UserController@addUserForm')->name('admin.add_user_form');
            Route::post('add','UserController@addUser')->name('admin.add_user');
            Route::get('list/','UserController@userList')->name('admin.userList');
            Route::get('list/ajax','UserController@userListAjax')->name('admin.userListAjax');

            Route::get('permission/edit/{id}','UserController@editUserPermission')->name('admin.edit_user_permission');
            Route::put('permission/update/{id}','UserController@updateUserPermission')->name('admin.update_user_permission');
            Route::get('edit/{id}','UserController@editUserForm')->name('admin.edit_user_form');
            Route::put('update/{id}','UserController@updateUser')->name('admin.update_user');
            Route::get('update/password/form/{user_id}','UserController@resetPasswordForm')->name('admin.reset_password_form');
            Route::put('change/password/{user_id}','UserController@changePassword')->name('admin.change_password');
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
            Route::group(['prefix'=>'pincode'],function(){
                Route::get('list','PincodeController@pincodeList')->name('admin.pincode_list');
                Route::get('list/ajax','PincodeController@pincodeListAjax')->name('admin.pincode_list.ajax');
                Route::get('form/{id?}','PincodeController@addPincode')->name('admin.pincode.form');
                Route::post('submit','PincodeController@submit')->name('admin.pincode.submit');
                Route::get('status/{id}','PincodeController@status')->name('admin.edit.status');
                Route::get('delete/{id}','PincodeController@delete')->name('admin.pincode.delete');
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

        Route::group(['prefix'=>'docate'],function(){
            Route::get('list','DocateController@docateList')->name('admin.docate_list');
            Route::get('fetch/docates','DocateController@docateListAjax')->name('admin.fetch_docates');
            Route::get('view/{id}','DocateController@viewDetails')->name('admin.view_details');
            Route::get('delete/{id}','DocateController@deleteDocate')->name('admin.delete_docate');
            Route::get('edit/form/{id}','DocateController@editForm')->name('admin.edit_form');
            Route::get('check/{cn_no}','DocateController@checkDocate')->name('admin.check_docate');
            Route::get('city/list/{state_id}','DocateController@cityList')->name('admin.list');
            Route::get('remove/content/{content_id}','DocateController@removeContent')->name('admin.remove_content');
            Route::put('update/{id}','DocateController@updateDocate')->name('admin.update_docate_details');
        });
        Route::group(['prefix'=>'manifest'],function(){
            Route::get('list','ManifestController@manifestList')->name('admin.manifest_list');
            Route::get('fetch/manifest/','ManifestController@manifestListAjax')->name('admin.fetch_manifests');
            Route::get('delete/{id}','ManifestController@deleteManifest')->name('admin.delete_manifest');
            Route::get('view/{id}','ManifestController@viewManifest')->name('admin.view_manifest');
            Route::get('edit/form/{id}','ManifestController@editForm')->name('admin.manifest_edit_form');
            Route::get('docate/delete/{id}','ManifestController@deleteDocateFromManifest')->name('admin.delete_docate_from_manifest');
            Route::get('fetch/details/{docate_no}','ManifestController@fetchDocateDetails')->name('admin.fetch_docate_details');
            Route::put('update/{manifest_id}','ManifestController@updateManifest')->name('admin.update_manifest');
        });

        Route::group(['prefix'=>'baging'],function(){
            Route::get('list','BagingController@bagingList')->name('admin.baging_list');
            Route::get('fetch/list/','BagingController@bagingListAjax')->name('admin.fetch_baging');
            Route::get('delete/{id}','BagingController@deleteBaging')->name('admin.delete_baging');
            Route::get('view/{id}','BagingController@viewBaging')->name('admin.view_baging');
            Route::get('edit/form/{id}','BagingController@editBagingForm')->name('admin.baging_edit_form');
            Route::get('docate/operation/{docate_id}/{baging_id}','BagingController@docateOperation')->name('admin.docate_operation');
            Route::put('update/{baging_id}','BagingController@updateBaging')->name('admin.update_baging');
        });

        Route::group(['prefix'=>'sectorbooking'],function(){
            Route::get('list','SectorBookingController@sectorList')->name('admin.sector_list');
            Route::get('fetch/sector/','SectorBookingController@sectorListAjax')->name('admin.fetch_sector');
            Route::get('delete/{id}','SectorBookingController@deleteSector')->name('admin.delete_sector');
            Route::get('edit/form/{id}','SectorBookingController@editSectorForm')->name('admin.sector_edit_form');
            Route::put('update/{sector_id}','SectorBookingController@updateSector')->name('admin.update_sector');
            Route::get('view/{id}','SectorBookingController@viewSector')->name('admin.view_sector');
        });

        Route::group(['prefix'=>'inbound'],function(){
            Route::get('list','InboundController@sectorPickupList')->name('admin.sector_pickup_list');
            Route::get('fetch/details/','InboundController@sectorPickupListAjax')->name('admin.sector_pickup_list_ajax');
            // Route::get('remove/{id}','InboundController@removeFromPickup')->name('admin.remove_from_pickup');
            Route::get('edit/form/','InboundController@editPickupForm')->name('admin.pickup_edit_form');
            Route::get('fetch/pickup/form/{cd_no}','InboundController@fetchPickupForm')->name('admin.fetch_pickup_form');
            Route::get('/pickup/operation/{docate_id}','InboundController@pickupOperation')->name('admin.pickup_operation');

            Route::get('drsprepared/list','InboundController@drsPreparedList')->name('admin.drs_prepared_list');
            Route::get('drsprepared/fetch/details/','InboundController@drsPreparedListAjax')->name('admin.drs_prepared_list_ajax');
            Route::get('drsprepared/remove/{id}','InboundController@removeFromDrsPrepared')->name('admin.remove_from_drs_prepared');
            Route::get('drsprepared/edit/form/{id}','InboundController@editDrsPreparedForm')->name('admin.drs_prepared_edit_form');
            Route::get('drsprepared/get/form/{docate_id}','InboundController@fetchDrsPreparedForm')->name('admin.drs_prepared_form');
            Route::put('drsprepared/update/{id}','InboundController@updateDrsPrepared')->name('admin.update_drs_prepared');
            Route::get('remove/drs/{id}','InboundController@removeDrs')->name('admin.remove_drs');

            // Route::get('drsclose/list','InboundController@drsCloseList')->name('admin.drs_close_list');
            // Route::get('drsclose/fetch/details/','InboundController@drsCloseListAjax')->name('admin.drs_close_list_ajax');
            // Route::get('drsclose/edit/form/','InboundController@editDrsCloseForm')->name('admin.edit_drs_close_form');
            // Route::get('drsclose/get/details/{drs_no}','InboundController@fetchDrsCloseForm')->name('admin.get_drs_close_details_form');
            // Route::get('drsclose/operation/{drs_no}','InboundController@drsCloseOperation')->name('admin.drs_close_operation');
           
        });

        Route::group(['prefix'=>'contact'],function(){
            Route::get('contact/list/form','ContactController@contactList')->name('admin.contact_list');
            Route::get('ajax/list','ContactController@contactListAjax')->name('admin.contact_list_ajax');

        });
        Route::group(['prefix'=>'enquiry'],function(){
            Route::get('list','EnquiryRequestController@list')->name('admin.enquiryList');
            Route::get('list/ajax','EnquiryRequestController@listAjax')->name('admin.enquiryListAjax');
            Route::get('details/{id}','EnquiryRequestController@details')->name('admin.enqueryRequest.details');
        });

        Route::group(['prefix'=>'partner'],function(){
            Route::get('delivery/executive/list','PartnerController@deliveryExecutiveList')->name('admin.delivery_executive_list');
            Route::get('delivery/executive/ajax/list','PartnerController@deliveryExecutiveListAjax')->name('admin.delivery_executive_list_ajax');

            Route::get('franchise/list/','PartnerController@franchiseList')->name('admin.franchise_list');
            Route::get('franchise/ajax/list','PartnerController@franchiseListAjax')->name('admin.franchise_list_ajax');

        });
    });
});