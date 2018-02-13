<?php

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
    return view('welcome');
});

Auth::routes();


Route::group([
        'prefix' => 'admin',
        'middleware' => ['auth']
    ],
function()
{
    Route::get('/home', 'HomeController@index')->name('home');

    // Order management
    Route::get('/home/order-listing', 'OrderListingController@getOrderListing')->name('admin.order-listing');
    Route::post('/home/order-listing/start-preparation/{id}', 'OrderListingController@postStartPreparingOrderable')->name('admin.order-listing.start-preparation');
    Route::post('/home/order-listing/finish-preparation/{id}', 'OrderListingController@postFinishPreparingOrderable')->name('admin.order-listing.finish-preparation');
    Route::post('/home/order-listing/deliver-order/{id}', 'OrderListingController@postDeliverOrderOrderable')->name('admin.order-listing.deliver-order');
    Route::post('/home/order-listing/remove-order/{id}', 'OrderListingController@postRemoveOrderOrderable')->name('admin.order-listing.remove-order');


    Route::get('/home/order-bookable/{id}', 'OrderListingController@getOrderBookable')->name('admin.order-bookable');
    Route::post('/home/order-bookable/{id}', 'OrderListingController@postOrderBookable')->name('admin.order-bookable');
    Route::post('/home/order-bookable/{id}/pay', 'OrderListingController@postOrderBookablePay')->name('admin.order-bookable-pay');
    Route::post('/home/order-bookable/{id}/multipay', 'OrderListingController@postOrderBookableMultipay')->name('admin.order-bookable-multipay');
    Route::post('/home/order-bookable/delete/{id}', 'OrderListingController@postDeleteOrderBookable')->name('admin.order-bookable.delete');
    Route::post('/home/order-bookable/create/{id}', 'OrderListingController@postCreateOrderBookable')->name('admin.order-bookable.create');

    // View feedback
    Route::get('/home/feedback', 'HomeController@getFeedbackListing')->name('admin.feedback-listing');

    Route::get('/home/reservations', 'ReservationController@getReservationView')->name('admin.reservations');

    // User management related routes
    Route::get('/home/user-management', 'UserManagementController@getUsers')->name('admin.user-management');
    Route::post('/home/user-management', 'UserManagementController@postCreateUser')->name('admin.user-management');
    Route::post('/home/user-management/delete/{id}', 'UserManagementController@postUserDelete')->name('admin.user-management.delete');
    Route::get('/home/user-management/edit/{id}', 'UserManagementController@getUserEdit')->name('admin.user-management.edit');
    Route::post('/home/user-management/edit/{id}', 'UserManagementController@postUserEdit')->name('admin.user-management.edit');

    // Orderables management related routes
    Route::get('/home/orderables-management', 'OrderablesController@getIndex')->name('admin.orderables-management');
    Route::post('/home/orderables-management', 'OrderablesController@postCreateOrderable')->name('admin.orderables-management');
    Route::post('/home/orderables-management/delete/{id}', 'OrderablesController@postDeleteOrderable')->name('admin.orderables-management.delete');
    Route::get('/home/orderables-management/edit/{id}', 'OrderablesController@getEditOrderable')->name('admin.orderables-management.edit');
    Route::post('/home/orderables-management/edit/{id}', 'OrderablesController@postEditOrderable')->name('admin.orderables-management.edit');

    // Menu management related routes
    Route::get('/home/edit-menu', 'MenuController@getMenuEditor')->name('admin.menu-editor');
    Route::post('/home/edit-menu', 'MenuController@postCreateMenu')->name('admin.menu-editor');
    Route::post('/home/edit-menu/delete/{id}', 'MenuController@postDeleteMenu')->name('admin.menu-editor.delete');
    Route::get('/home/edit-menu/edit/{id}', 'MenuController@getEditMenu')->name('admin.menu-editor.edit');
    Route::post('/home/edit-menu/edit/{id}', 'MenuController@postEditMenu')->name('admin.menu-editor.edit');

    // Reservation routes
    Route::post('/home/reservations/{id}/deny', 'ReservationController@postDenyReservation')->name('admin.reservations.deny');
    Route::post('/home/reservations/{id}/confirm', 'ReservationController@postConfirmReservation')->name('admin.reservations.confirm');
    Route::post('/home/reservations/{id}/storno', 'ReservationController@postStornoReservation')->name('admin.reservations.storno');

});

// Public - restaurant routes

Route::get('/restaurant', 'RestaurantController@getIndex')->name('public.main');
Route::get('/restaurant/reservation', 'RestaurantController@getReservation')->name('public.reservation');
Route::get('/restaurant/feedback', 'RestaurantController@getFeedback')->name('public.feedback');
Route::post('/restaurant/feedback', 'RestaurantController@postFeedback')->name('public.feedback');
Route::get('/restaurant/storno', 'RestaurantController@getStorno')->name('public.storno');

Route::post('/restaurant/reservation', 'RestaurantController@postCreateReservation')->name('public.reservation');
Route::get('/restaurant/reservation/{date}/{from}/{to}', 'RestaurantController@getExistingReservations')->name('public.reservation-getdata');

Route::post('/restaurant/storno', 'RestaurantController@postStornoReservation')->name('public.storno');
