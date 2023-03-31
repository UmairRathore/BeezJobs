<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfessionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\FreelancerDashboardController;
use App\Http\Controllers\Frontend\JobController;
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
Route::get('/users/random', [UserController::class, 'createRandomUsers'])->name('add.random');
Route::get('/jobs/random', [JobController::class, 'createRandomJobs'])->name('add.random.jobs');


Route::get('/', [HomeController::class, 'index'])->name('index');


Route::get('/signup', [RegistrationController::class, 'signup'])->name('signup');
Route::post('/signup', [RegistrationController::class, 'postsignUp'])->name('postsignup');

Route::get('/signout', [LoginController::class, 'signout'])->name('signout');
Route::get('/signin', [LoginController::class, 'signin'])->name('signin');
Route::post('/signin', [LoginController::class, 'postsignin'])->name('postsignin');


Route::get('/freelancesignup', [RegistrationController::class, 'freelancesignup'])->name('freelance');
Route::post('/freelancesignup', [RegistrationController::class, 'postfreelancesignup'])->name('freelancesignup');
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
Route::get('/browse_freelancers', [FreelancerDashboardController::class, 'browse_freelancers'])->name('browse_freelancers');



//OtherFreelancer
Route::get('/other_freelancer_profile/{id}', [FreelancerDashboardController::class, 'other_freelancer_profile'])->name('other_freelancer_profile');
Route::get('/other_freelancer_portfolio/{id}', [FreelancerDashboardController::class, 'other_freelancer_portfolio'])->name('other_freelancer_portfolio');
Route::get('/other_freelancer_review/{id}', [FreelancerDashboardController::class, 'other_freelancer_review'])->name('other_freelancer_review');

//portfolio
Route::post('/add_freelancer_portfolio', [PortfolioController::class, 'add_freelancer_portfolio'])->name('add_freelancer_portfolio');
Route::get('/delete_freelancer_portfolio/{id}', [PortfolioController::class, 'delete_freelancer_portfolio'])->name('delete_freelancer_portfolio');




//Job
Route::get('/post_a_job', [JobController::class, 'showJob'])->name('post_a_job');
Route::post('/post_a_job', [JobController::class, 'createJob'])->name('post_a_job');
Route::get('/browse_jobs', [JobController::class, 'browse_jobs'])->name('browse_jobs');
Route::get('/job_single_view', [JobController::class, 'job_single_view'])->name('job_single_view');





//backend
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');





//City
Route::get('/city-list', [CityController::class, 'index'])->name('backend.city-list');
Route::get('/add-city', [CityController::class, 'create'])->name('backend.show-city');
Route::post('/add-city', [CityController::class, 'store'])->name('backend.add-city');
Route::get('/edit-city/{id}', [CityController::class, 'edit'])->name('backend.edit-city');
Route::put('/update-city/{id}', [CityController::class, 'update'])->name('backend.update-city');
Route::get('/delete-city/{id}', [CityController::class, 'destroy'])->name('backend.delete-city');

//Profession
Route::get('/profession-list', [ProfessionController::class, 'index'])->name('backend.profession-list');
Route::get('/add-profession', [ProfessionController::class, 'create'])->name('backend.show-profession');
Route::post('/add-profession', [ProfessionController::class, 'store'])->name('backend.add-profession');
Route::get('/edit-profession/{id}', [ProfessionController::class, 'edit'])->name('backend.edit-profession');
Route::put('/update-profession/{id}', [ProfessionController::class, 'update'])->name('backend.update-profession');
Route::get('/delete-profession/{id}', [ProfessionController::class, 'destroy'])->name('backend.delete-profession');

//User
Route::get('/user-list', [UserController::class, 'index'])->name('backend.user-list');
Route::get('/edit-user/{id}', [UserController::class, 'edit'])->name('backend.edit-user');
Route::put('/update-user/{id}', [UserController::class, 'update'])->name('backend.update-user');
Route::get('/delete-user/{id}', [UserController::class, 'destroy'])->name('backend.delete-user');
Route::post('/status-user/{id}', [UserController::class, 'changeStatus'])->name('status-user');

//Admin
Route::get('/admin-profile/{id}', [AdminController::class, 'edit'])->name('backend.edit-admin');
Route::put('/admin-profile/{id}', [AdminController::class, 'update'])->name('backend.update-admin');

//profession
Route::get('/create_profession', [ProfessionController::class, 'showProfession'])->name('profession.show');
Route::post('/create_profession', [ProfessionController::class, 'createProfession'])->name('profession.store');

//Role
Route::get('/create_role', [RoleController::class, 'showRole'])->name('role.show');
Route::post('/create_role', [RoleController::class, 'createRole'])->name('role.store');




////Login
//Route::get('/login', [LoginController::class, 'login'])->name('login');
//Route::post('/login', [LoginController::class, 'postLogin'])->name('postlogin');
//
//Logout
//Route::post('logout', [LoginController::class, 'logout'])->name('logout');
//
////Forget Password
Route::get('/forget', [LoginController::class, 'showForgetPasswordForm'])->name('forget.password');
Route::post('/forget', [LoginController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('/reset-password/{token}', [LoginController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [LoginController::class, 'submitResetPasswordForm'])->name('reset.password.post');
