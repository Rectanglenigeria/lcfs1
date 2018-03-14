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

Route::get('/', 'Auth\RegisterController@showRegistrationForm')->name('register');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/user/block', function(){
	return view('pages.errors.block');
});


	Route::get('/activate_user/{id}', 'Auth\RegisterController@showActivationForm');

	Route::post('/activate_user', 'Auth\RegisterController@activateUser');

	Route::get('/reVerify/{id}', 'Auth\RegisterController@reVerify');


Route::group(['middleware'=>['auth', 'is_block']], function (){
	Route::get('/user_profile','UserProfileController@read'); //does not consider is_active middleware
	Route::post('/user_profile','UserProfileController@update'); 
});


Route::group(['middleware'=>['auth','completeProfile','is_block']], function(){

	Route::get('/dashboard', 'UserDashboardController@index');

	Route::get('/home', 'UserDashboardController@index');

	Route::get('/news/list','NewsController@read');

	

	Route::get('/news/view/{news_id}', 'NewsController@view');

	Route::get('/testimonials/create','TestimonialsController@getReceivedSmiles');

	Route::post('/testimonials/create', 'TestimonialsController@create');

	Route::get('/testimonials/list', 'TestimonialsController@listTest');

	Route::get('/testimonials/view/{testimony_id}', 'TestimonialsController@view');

	Route::get('/gsmile/create', 'PsController@showGsmileForm');

	Route::post('/gsmile/create', 'PsController@create');

	Route::get('/wallet/view', 'WalletController@view');

	Route::get('/gsmile/achieved', 'PsController@achieved');

	Route::get('/rsmile/create', 'RsmileController@showMaturedGs');

	Route::post('/rsmile/create', 'RsmileController@create');

	Route::get('/bonus/list', 'BonusController@listBonus');

	Route::get('/bonus/referer/receive/{id}', 'BonusController@receiveRefererBonus');

	Route::get('/bonus/video/receive/{id}', 'BonusController@receiveVideoBonus');









	Route::get('/matches/view/{match_id}', 'MatchuserController@view');

	Route::get('/matches/viewrs/{match_id}', 'MatchuserController@viewrs');

	Route::get('/matches/extend_time/{match_id}', 'MatchuserController@extendPaymentTime');

	Route::post('/matches/uploadteller','MatchuserController@UploadPaymentTeller');

	Route::get('/matches/uploadteller','MatchuserController@UploadPaymentTeller');

	Route::post('/matches/confirmpayment','MatchuserController@ConfirmPayment');

	Route::get('/matches/fakeReceipt/{match_id}','MatchuserController@FakeReceipt');


	Route::post('/retainment/createNewGS','RetainmentController@createNewGS');

	Route::post('/retainment/receive','RetaimentController@create');






});


//pages routes
Route::get('/about', 'PagesController@about');

Route::get('/contact', 'PagesController@contact');

Route::get('/faqs', 'PagesController@faqs');

Route::get('/testimonial', 'PagesController@testimonial');

Route::get('/testimonial/view/{testimony_id}', 'PagesController@getTestimony');

Route::post('/contact_message/send','MessageController@sendContactMessage');

Route::get('/passwords/reset', 'PasswordController@view');

Route::post('/passwords/reset', 'PasswordController@reset');

Route::post('/passwords/verifyCode', 'PasswordController@verifyCode');

Route::get('/passwords/getNew/{user_id}', 'PasswordController@showGetForm');

Route::get('/passwords/update/{user_id}', 'PasswordController@showUpdateForm');

Route::post('/passwords/update', 'PasswordController@updatePassword');


