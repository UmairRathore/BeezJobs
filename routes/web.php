<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FreelancerDashboardController;
use App\Http\Controllers\Frontend\PortfolioController;

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


//Authentication


Route::get('/', [HomeController::class, 'index'])->name('index');


Route::get('/signup', [RegistrationController::class, 'signup'])->name('signup');
Route::post('/signup', [RegistrationController::class, 'postsignUp'])->name('postsignup');

Route::get('/signout', [LoginController::class, 'signout'])->name('signout');
Route::get('/signin', [LoginController::class, 'signin'])->name('signin');
Route::post('/signin', [LoginController::class, 'postsignin'])->name('postsignin');


Route::post('/freelancesignup', [RegistrationController::class, 'freelancesignup'])->name('freelancesignup');
Route::post('/companysignup', [RegistrationController::class, 'companysignup'])->name('companysignup');

Route::get('/selectprofile', [RegistrationController::class, 'selectprofile'])->name('selectprofile');
Route::get('/selectprofile/{role_id}', [RegistrationController::class, 'postselectprofile'])->name('postselectprofile');
//freelancer
Route::get('/my_freelancer_dashboard', [FreelancerDashboardController::class, 'my_freelancer_dashboard'])->name('my_freelancer_dashboard');
Route::get('/my_freelancer_setting', [FreelancerDashboardController::class, 'my_freelancer_settings'])->name('my_freelancer_setting');
Route::get('/my_freelancer_messages', [FreelancerDashboardController::class, 'my_freelancer_messages'])->name('my_freelancer_messages');
Route::get('/my_freelancer_jobs', [FreelancerDashboardController::class, 'my_freelancer_jobs'])->name('my_freelancer_jobs');
Route::get('/my_freelancer_bids', [FreelancerDashboardController::class, 'my_freelancer_bids'])->name('my_freelancer_bids');
Route::get('/my_freelancer_portfolio', [FreelancerDashboardController::class, 'my_freelancer_portfolio'])->name('my_freelancer_portfolio');
Route::get('/my_freelancer_bookmarks', [FreelancerDashboardController::class, 'my_freelancer_bookmarks'])->name('my_freelancer_bookmarks');
Route::get('/my_freelancer_payments', [FreelancerDashboardController::class, 'my_freelancer_payments'])->name('my_freelancer_payments');
Route::get('/my_freelancer_profile', [FreelancerDashboardController::class, 'my_freelancer_profile'])->name('my_freelancer_profile');
Route::get('/my_freelancer_notifications', [FreelancerDashboardController::class, 'my_freelancer_notifications'])->name('my_freelancer_notifications');
Route::get('/my_freelancer_reviews', [FreelancerDashboardController::class, 'my_freelancer_reviews'])->name('my_freelancer_reviews');
//setting
Route::post('/update_freelancer_social_media_links', [FreelancerDashboardController::class, 'update_freelancer_social_media_links'])->name('update_freelancer_social_media_links');
Route::post('/change_freelancer_password', [FreelancerDashboardController::class, 'change_freelancer_password'])->name('change_freelancer_password');
//portfolio
Route::post('/add_freelancer_portfolio', [PortfolioController::class, 'add_freelancer_portfolio'])->name('add_freelancer_portfolio');
Route::get('/delete_freelancer_portfolio/{id}', [PortfolioController::class, 'delete_freelancer_portfolio'])->name('delete_freelancer_portfolio');


////Login
//Route::get('/login', [LoginController::class, 'login'])->name('login');
//Route::post('/login', [LoginController::class, 'postLogin'])->name('postlogin');
//
////Logout
//Route::post('logout', [LoginController::class, 'logout'])->name('logout');
//
////Forget Password
Route::get('/forget', [LoginController::class, 'showForgetPasswordForm'])->name('forget.password');
Route::post('/forget', [LoginController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('/reset-password/{token}', [LoginController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [LoginController::class, 'submitResetPasswordForm'])->name('reset.password.post');
//
//
//
////Registration
//Route::get('/usersignup', [RegistrationController::class, 'user'])->name('user-register');
//Route::post('/usersignup', [RegistrationController::class, 'userregistration'])->name('userregisteration');
