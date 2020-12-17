<?php


use Illuminate\Support\Facades\Route;

    // -------- Index---------
Route::get('/', function () {
    return view('web.index');
})->name('web.index');

// -------- About---------
Route::get('/about', function () {
    return view('web.about.about');
})->name('web.about.about');

// -------- Tracking---------
Route::get('/trackingold', function () {
    return view('web.tracking.tracking-old');
})->name('web.tracking.tracking-old');

Route::get('/tracking', function () {
    return view('web.tracking.tracking');
})->name('web.tracking.tracking');

// Route::get('/trackingdetails', function () {
//     return view('web.tracking.trackingdetails');
// })->name('web.tracking.trackingdetails');


// -------- Parcel Book---------
Route::get('/parcel', function () {
    return view('web.parcelbook.parcelbook');
})->name('web.parcelbook.parcelbook');

// -------- Pin code search---------
Route::get('/pinsearch', function () {
    return view('web.pinsearch.pinsearch');
})->name('web.pinsearch.pinsearch');

// -------- Partner with us---------
Route::get('/partner', function () {
    return view('web.partner.partner');
})->name('web.partner.partner');

// -------- Delivery Executive---------
// Route::get('/deliveryExecutive', function () {
//     return view('web.delivery.delivery-executive');
// })->name('web.delivery.delivery-executive');


// --------Franchise partner ---------
// Route::get('/franchise', function () {
//     return view('web.franchise.franchise');
// })->name('web.franchise.franchise');


// --------Contact us ---------
Route::get('/contact', function () {
    return view('web.contact.contact');
})->name('web.contact.contact');
Route::group(['namespace' => 'Web'], function () {   
    Route::get('/tracking/details','TrackingController@trackingDetails')->name('web.tracking_details');
    Route::get('/deliveryExecutive','TrackingController@deliveryExecutive')->name('web.delivery_exectutive');
    Route::get('/franchise','TrackingController@franchise')->name('web.franchise');
    Route::post('/add/contacts','TrackingController@addContacts')->name('web.add_contacts');
    Route::post('/add/partner/{type}','TrackingController@addPartner')->name('web.add_partner');
});
