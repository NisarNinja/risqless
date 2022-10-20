<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthUser\UserLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\CheckStatus;
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

// Auth::routes();

// Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
// Route::get('admin/login', [LoginController::class, 'login'])->name('admin.login');
// Route::post('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');


// Authentication Routes...
Route::get('admin/login', [
  // 'as' => 'login',
  'uses' => 'App\Http\Controllers\Auth\LoginController@showLoginForm'
])->name('admin.login');

Route::post('admin/login', [
  'as' => '',
  'uses' => 'App\Http\Controllers\Auth\LoginController@login'
])->name('admin.login');

Route::post('admin/logout', [
  'uses' => 'App\Http\Controllers\Auth\LoginController@logout'
])->name('admin.logout');

// Route::post('admin/login', [ 'as' => 'login', 'uses' => 'LoginController@showLoginForm']);

// Password Reset Routes...
// Route::post('password/email', [
//   'as' => 'password.email',
//   'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
// ]);
// Route::get('password/reset', [
//   'as' => 'password.request',
//   'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
// ]);
// Route::post('password/reset', [
//   'as' => 'password.update',
//   'uses' => 'Auth\ResetPasswordController@reset'
// ]);


// Route::post('admin/logout', 'LoginController@logout')->name('admin.logout');

// Admin Routes
Route::prefix('admin')->middleware(['auth:web','check.role:admin'])->group(function () {

	Route::get('dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
  	
  Route::get('acount-settings/{id}/edit', [AdminController::class, 'edit'])->name('admin.account.edit');
  Route::put('acount-settings/{id}', [AdminController::class, 'update'])->name('admin.account.update');

  Route::resource('header', 'App\Http\Controllers\HeaderController');

});

// User Routes
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about-us', [App\Http\Controllers\HomeController::class, 'about_us'])->name('about-us');

Route::middleware([CheckStatus::class,'subscribed'])->group(function () {
  Route::get('/file', [App\Http\Controllers\HomeController::class, 'file'])->name('file');
});

Route::get('api/file',[HomeController::class,'fileAPI']);

Route::middleware([CheckStatus::class])->group(function () {
  Route::get('/card-details', [App\Http\Controllers\HomeController::class, 'card_details'])->name('card_details');
});
// File Drag and Drop Upload
Route::get('upload-ui', [App\Http\Controllers\FileUploadController::class, 'dropzoneUi' ]);
Route::post('file-upload', [App\Http\Controllers\FileUploadController::class, 'dropzoneFileUpload' ])->name('dropzoneFileUpload');

Route::post('file-upload-button', [App\Http\Controllers\FileUploadController::class, 'buttonFileUpload' ])->name('buttonFileUpload');

Route::get('/login','App\Http\Controllers\AuthUser\UserLoginController@show_login_form')->name('user.show.login');
Route::post('/login','App\Http\Controllers\AuthUser\UserLoginController@process_login')->name('user.login');

Route::get('/register','App\Http\Controllers\AuthUser\UserLoginController@show_signup_form')->name('user.show.register');
Route::post('/register','App\Http\Controllers\AuthUser\UserLoginController@process_signup')->name('user.register');

Route::post('/checkemail','App\Http\Controllers\AuthUser\UserLoginController@checkEmail')->name('checkEmail');

Route::post('/storelead','App\Http\Controllers\AuthUser\UserLoginController@storeLeadInHubspot')->name('storeLeadInHubspot');

Route::post('/logout','App\Http\Controllers\AuthUser\UserLoginController@logout')->name('user.logout');

Route::get('/forgot-password','App\Http\Controllers\AuthUser\UserLoginController@show_forget_password_form')->name('password.reset');
Route::post('/forgot-password','App\Http\Controllers\AuthUser\UserLoginController@process_forget_password')->name('user.forget_password');

Route::get('reset-password',  'App\Http\Controllers\AuthUser\UserLoginController@show_reset_form')->name('user.password.reset');
Route::post('reset-password',  'App\Http\Controllers\AuthUser\UserLoginController@process_reset_password')->name('password.update');

// Goolge login
Route::get('/redirect', 'App\Http\Controllers\AuthUser\UserLoginController@redirectToProvider')->name('google.login');
Route::get('/callback-google', 'App\Http\Controllers\AuthUser\UserLoginController@handleProviderCallback');

// Facebook Login

Route::get('auth/facebook', 'App\Http\Controllers\AuthUser\UserLoginController@facebookRedirect')->name('facebook.login');
Route::get('auth/facebook/callback', 'App\Http\Controllers\AuthUser\UserLoginController@loginWithFacebook')->name('facebook.callback');


// Stripe Subscriptions

Route::post('/subscribe','App\Http\Controllers\SubscriptionController@processSubscription')->name('processSubscription');

Route::post('/cancel-subscribe','App\Http\Controllers\SubscriptionController@cancelSubscription')->name('cancelSubscription');

Route::post('/resume-subscribe','App\Http\Controllers\SubscriptionController@resumeSubscription')->name('resumeSubscription');

Route::post('/cancel-trial','App\Http\Controllers\SubscriptionController@cancelTrial')->name('cancelTrial');

Route::get("/privacy-policy",function(){
  return view("user.pages.privacy-policy");
});

