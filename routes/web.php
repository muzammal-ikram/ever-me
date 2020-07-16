<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();

Auth::routes(['verify' => true]);

Route::namespace('Admin')->group(function() {
	Route::group(['middleware' => ['auth', 'verified']], function() {

		Route::get('/home', 'HomeController@index')->name('home');

        // resource route for users
        Route::resource('users', 'UserController');

        // resource route for property
        Route::resource('properties', 'PropertyController');

        //preference
        Route::post('set_property_preference', 'PropertyController@updatePreference');
        Route::post('property/media', 'PropertyController@storeMedia')->name('property.storeMedia');

        // resource route for property resource
        Route::resource('properties/{property_id}/property-resources', 'PropertyResourceController');

        // property resource media
        Route::get('property-resources/{resource_id}', 'PropertyMediaController@edit');
        Route::post('property-resource-media', 'PropertyMediaController@storeMedia')->name('resource.storeMedia');
        Route::post('store-resource-media', 'PropertyMediaController@store');
        
        // resource route for property section
        Route::resource('properties/{property_id}/property-resources/{property_resource_id}/property-sections', 'PropertySectionController');
        Route::post('update-section', 'PropertySectionController@update');
        Route::post('/section-sortable', 'PropertySectionController@sectionSortable');
        Route::get('delete-section/{id}', 'PropertySectionController@deleteSection');

        // user profile resource route for my account
        Route::resource('users-profile'    ,  'UserProfileController');
        Route::post('users-profile/change-password',  'UserProfileController@userPasswordChange');

        //Section Information route
        Route::resource('section-info', 'SectionInformationController');
        Route::get('delete-section-info/{info}', 'SectionInformationController@destroy');
        Route::post('sectioninfo/media', 'SectionInformationController@storeMedia')->name('sectioninfo.storeMedia');
	});
});

Route::namespace('GuestSite')->group(function(){
       //SendEmail from contact
       Route::post('send-email', 'GuestSiteController@contactEmail')->name('contact-email');

    Route::group(['prefix' => 'guest'], function () {
        Route::get('/site{property_id}/{uuid}', 'GuestSiteController@guestSite');
        Route::get('/site{property_id}', 'GuestSiteController@guestSite')->middleware('property_preference');
        Route::get('/property_preference_password/{property_id}', 'GuestSiteController@propertyPreferencePassword');
        Route::post('/restricted_property_login', 'GuestSiteController@restrictedPropertyLogin')->name('restricted_login');
        Route::get('/nearby/{property_id}/{type}', 'GuestSiteController@nearbyProperty');
    });
});

Route::fallback(function() {
    return 'Hm, why did you land here somehow?';
});


