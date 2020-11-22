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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/search', 'SearchController@index')->name('search');

// Property related routes:
Route::get('/property/new', 'PropertyController@new')->name('new_property')->middleware('auth');
Route::get('/property/edit/{id}', 'PropertyController@edit')->name('edit_property')->middleware('auth');
Route::get('/property/{slug}', 'PropertyController@single')->name('single_property');

// Admin Routes:
Route::get('/admin/property-status', 'PropertyStatusController@listPropertyStatus')->name('list_property_status')->middleware('admin');
Route::get('/admin/property-status/new', 'PropertyStatusController@newPropertyStatus')->name('new_property_status')->middleware('admin');
Route::get('/admin/property-status/edit/{id}', 'PropertyStatusController@editPropertyStatus')->name('edit_property_status')->middleware('admin');

Route::get('/admin/settings', 'Admin\SettingsController@index')->name('list_admin_settings')->middleware('admin');
Route::get('/admin/limits', 'Admin\LimitsController@index')->name('list_admin_limits')->middleware('admin');
Route::get('/admin/defaults', 'Admin\DefaultsController@index')->name('list_admin_defaults')->middleware('admin');

// API methods:
Route::get('/api/locations', 'LocationController@getLocations')->name('get_locations');
Route::get('/api/location/children', 'LocationController@getChildLocations')->name('get_child_locations');
Route::get('/api/location/children/row', 'LocationController@getChildLocationsMenu')->name('get_child_locations_row');

Route::post('/api/property/save', 'PropertyController@save')->name('save_property')->middleware('auth');

Route::post('/api/search/property', 'PropertyController@search')->name('search_properties');

Route::get('/api/admin/property-status', 'PropertyStatusController@getPropertyStatus')->name('get_property_status')->middleware('admin');
Route::post('api/admin/property-status', 'PropertyStatusController@savePropertyStatus')->name('save_property_status')->middleware('admin');
Route::delete('/api/admin/property-status', 'PropertyStatusController@deletePropertyStatus')->name('delete_property_status')->middleware('admin');
Route::delete('/api/admin/property-status/remove', 'PropertyStatusController@removePropertyStatus')->name('remove_property_status')->middleware('admin');
Route::put('/api/admin/property-status/restore', 'PropertyStatusController@restorePropertyStatus')->name('restore_property_status')->middleware('admin');

// Save setting: 
Route::post('/api/admin/setting/save', 'Admin\SettingsController@save')->name('save_setting')->middleware('admin');
Route::post('/api/admin/limit/save', 'Admin\LimitsController@save')->name('save_limit')->middleware('admin');
Route::post('/api/admin/default/save', 'Admin\DefaultsController@save')->name('save_default')->middleware('admin');

Route::post('media/save', 'MediaController@save')->name('save_media')->middleware('auth');