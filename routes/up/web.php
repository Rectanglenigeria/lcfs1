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



//admin route

Route::group(['prefix'=>'admin'], function ()
{
	Route::get('login', 'Admin\AuthController@showLoginForm');

	Route::post('login' ,'Admin\AuthController@login');

	Route::get('register', 'Admin\AuthController@showRegistrationForm');

	Route::post('register', 'Admin\AuthController@CreateAdminUser');

	Route::get('logout', 'Admin\AuthController@logout');

	Route::get('home', 'Admin\DashboardController@readLatestUsers');

	Route::get('dashboard', 'Admin\DashboardController@readLatestUsers');

	Route::get('user/list', 'Admin\UserController@read');

	Route::get('user/view/{id}', 'Admin\UserController@view');

	Route::get('user/delete/{id}', 'Admin\UserController@delete');

	Route::get('user/block/{id}', 'Admin\UserController@blockUser');

	Route::get('user/unblock/{id}', 'Admin\UserController@unBlockUser');

	Route::get('user/make_pioneer/{id}', 'Admin\UserController@makePioneer');

	Route::get('user/unmake_pioneer/{id}', 'Admin\UserController@unmakePioneer');


	Route::get('user/make_teamlead/{id}', 'Admin\UserController@makeTeamLead');

	Route::get('user/unmake_teamlead/{id}', 'Admin\UserController@unmakeTeamLead');


	Route::get('gsmile/list', 'Admin\GGGsmileController@list');

	Route::get('gsmile/view/{id}', 'Admin\GGGsmileController@view');

	Route::get('gsmile/delete/{id}', 'Admin\GGGsmileController@delete');

	Route::get('rsmile/list', 'Admin\RsmileController@list');

	Route::get('rsmile/view/{id}', 'Admin\RsmileController@view');

	Route::get('rsmile/delete/{id}', 'Admin\RsmileController@delete');

	Route::get('matches/list/', 'Admin\MatchuserController@read');

	Route::get('matches/unmatch/{id}', 'Admin\MatchuserController@unmatch');

	Route::get('matches/select_gs_users/{rs_id}','Admin\MatchuserController@SelectUnmatchedGs');

	Route::post('matches/create','Admin\MatchuserController@MatchManually');

	Route::get('testimony/list','TestimonialsController@listForAdmin');

	Route::get('testimony/view/{id}','TestimonialsController@viewForAdmin');

	Route::get('testimony/approve/{id}','TestimonialsController@approveTestimony');

	Route::get('testimony/video/approve/{id}','TestimonialsController@approveTestimonyAndVideo');

	Route::get('/news/list','NewsController@readForAdmin');

	Route::get('/news/view/{news_id}', 'NewsController@viewForAdmin');

	Route::get('/news/create', 'NewsController@showNewsForm');

	Route::get('/news/delete/{id}','NewsController@delete');

	Route::post('/news/create', 'NewsController@create');


	Route::get('/message/list', 'MessageController@readForAdmin');

	Route::get('/message/view/{id}', 'MessageController@viewForAdmin');

	Route::get('/automatch/pause', 'Admin\AutomatchController@stop');

	Route::get('/automatch/start', 'Admin\AutomatchController@start');

	Route::post('/insurance/update', 'Admin\DashboardController@updateInsurance');



	Route::get('/fasttrack/view', 'Admin\FasttrackController@view');

	Route::get('/fasttrack/stage/{gsmile_id}', 'Admin\FasttrackController@stage');

	Route::get('/fasttrack/match/{rsmile_id}', 'Admin\FasttrackController@match');


	//triggered blocking
	Route::get('/timeout/block', 'Admin\BgController@run');

	Route::get('/trigger/automatch', 'Admin\BgController@runAutoMatch');



	//statistics 
	Route::get('/stats/view', 'Admin\StatController@view');


	Route::post('/user/update','UserProfileController@updateForAdmin'); 





	






}
	);



