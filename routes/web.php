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
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'admin',
    'namespace' => 'Admin'
    // 'middleware' =>'admin'
], function () {
	Route::get('/dashboard','AdminController@index');
	Route::get('/login','LoginController@getLogin');
	Route::post('/login','LoginController@postLogin');
	Route::get('/register','LoginController@getRegister');
	Route::post('/register','LoginController@postRegister');
	Route::get('/logout', 'LoginController@getlogout');
// ------------------------------------------------------------------------ 
	Route::get('/category/all','CategoryController@CateAll');
	Route::get('/category/add','CategoryController@getAdd');
	Route::post('/category/add','CategoryController@postAdd');
	Route::get('/category/edit/{id}','CategoryController@getEdit');
	Route::post('/category/edit/{id}','CategoryController@postEdit');
	Route::get('/category/delete/{id}','CategoryController@delete');
	Route::post('/import-csv','CategoryController@import_csv');
	Route::post('/export-csv','CategoryController@export_csv');
//---------------------------------------------------------------------------
	Route::get('/brand/all','BrandController@BrandAll');
	Route::get('/brand/add','BrandController@getBrandAdd');
	Route::post('/brand/add','BrandController@postBrandAdd');
	Route::get('/brand/edit/{id_brand}','BrandController@getBrandEdit');
	Route::post('/brand/edit/{id_brand}','BrandController@postBrandEdit');
	Route::get('/brand/delete/{id_brand}','BrandController@Branddelete');

	Route::get('/product/all','ProductController@productAll');
	Route::get('/product/add','ProductController@getAdd');
	Route::post('/product/add','ProductController@postAdd');
	Route::get('/product/edit/{id}','ProductController@getEdit');
	Route::post('/product/edit/{id}','ProductController@postEdit');
	Route::get('/product/delete/{id}','ProductController@delete');
//----------------order------------------------------------
	Route::get('/order/all','OrderController@ordertAll');
	Route::get('/view-order/{order_code}','OrderController@view_order');
	Route::get('/print-order/{checkout_code}','OrderController@print_order');
	Route::post('/update-order-qty','OrderController@update_order_qty');
	Route::post('/update-qty','OrderController@update_qty');

	Route::get('/coupon/all','CouponController@getCoupon');
	Route::get('/coupon/add','CouponController@getAdd');
	Route::post('/coupon/add','CouponController@postAdd');
	Route::get('/coupon/delete/{id}','CouponController@getDelete');

//-----------login facebook-----------------------------------//
	// Route::get('/login-facebook','AdminController@login_facebook');
	// Route::get('/callback','AdminController@callback_facebook');
//-----------login google--------------------------------------//
	Route::get('/redirect/{provider}','AdminController@redirect');
	Route::get('/admin/callback/{provider}','AdminController@callback');
//----------------------delivery-------------------------------------
	Route::get('/delivery/add','DeliveryController@getAdd');
	Route::post('/select-delivery','DeliveryController@select_delivery');
	Route::post('/insert-delivery','DeliveryController@insert_delivery');
	Route::post('/select-feeship','DeliveryController@feeship');
	Route::post('/update-feeship','DeliveryController@update_feeship');
//---------------------danh muc bai viet-------------------------------
	Route::get('/cate_post/all','CatePostController@getAll');
	Route::get('/cate_post/add','CatePostController@getAdd');
	Route::post('/cate_post/add','CatePostController@postAdd');
	Route::get('/cate_post/edit/{id}','CatePostController@getEdit');
	Route::post('/cate_post/edit/{id}','CatePostController@postEdit');
	Route::get('/cate_post/delete/{id}','CatePostController@getDelete');
//--------------------------tạo bài viết---------------------------
	Route::get('/post/all','PostController@getAll');
	Route::get('/post/add','PostController@getAdd');
	Route::post('/post/add','PostController@postAdd');
	Route::get('/post/edit/{id}','PostController@getEdit');
	Route::post('/post/edit/{id}','PostController@postEdit');		
	Route::get('/post/delete/{id}','PostController@getDelete');	
});

Route::group([
    'namespace' => 'Frontend',
    // 'middleware' =>'admin'
], function () {
	Route::get('/index','HomeController@index');
	Route::post('/tim-kiem','HomeController@search');

	Route::get('/member/login','LoginController@getLogin');
	Route::post('/member/login','LoginController@postLogin');
	Route::get('/member/register','LoginController@getRegister');
	Route::post('/member/register','LoginController@postRegister');
	Route::get('/member/logout', 'LoginController@getlogout');
	Route::get('/danhmucsanpham/{category_id}','HomeController@Show_category');
	Route::get('/thuonghieusanpham/{brand_id}','HomeController@Show_brand');

	Route::get('/chitietsanpham/{product_id}','CartController@Details_product');
//-------------------------coupon-------------------------------
	Route::get('/show-cart','CartController@getCart');
	Route::post('/check-coupon','CartController@check_coupon');
	Route::get('/delete-coupon','CartController@delete_coupon');
	Route::get('/Add-Cart/{id}','CartController@AddCart');
	Route::post('/add-cart-ajax','CartController@add_cart_ajax');
	Route::post('/update-cart','CartController@updateCart');
	Route::get('/delete-sp/{session_id}','CartController@delete_product');
	Route::get('/delete-all-sp','CartController@delete_all_product');


	Route::get('/checkout','CheckoutController@show_checkout');
	// Route::post('/checkout-shipping','CheckoutController@post_checkout');
	Route::post('/select-delivery/checkout','CheckoutController@select_delivery_checkout');
	Route::post('/calculate-fee','CheckoutController@calculate_fee');
	Route::get('/delete-fee','CheckoutController@delete_fee');
//------------confirm order------------------------------//	
	Route::post('/confirm-order','CheckoutController@confirm_order');

	Route::get('/payment','CheckoutController@payment');
	Route::post('/payment','CheckoutController@order_place');
	// Route::post('/show-checkout','CheckoutController@post_show_checkout');

	//send mail
	Route::get('/send-mail','MailController@send_mail');
//----------------danh mục bài viêt---------------------
	Route::get('/danh-muc-bai-viet/{post_slug}','HomeController@danhmucbaiviet');
	Route::get('/bai-viet/{post_slug}','HomeController@baiviet');
});