<?php

use App\Http\Controllers\AamarpayController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\WithdrawalsController;
use App\Http\Controllers\RatingsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AwardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentScreenshotsControllers;
use App\Http\Controllers\AppsettingsController;
use App\Http\Controllers\CoinsController;
use App\Http\Controllers\UserCallsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\CustomLoginController;
use App\Http\Controllers\WorksController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\InactiveUsersController;
use App\Http\Controllers\BankDetailsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ExtraBonusController;
use App\Http\Controllers\EarningsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OTPResetsController;



// use App\Http\Controllers\PlanRequestController;

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

// Redirect root to login if not authenticated
Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('mobile.login');
});

Route::get('mobile-login', [CustomLoginController::class, 'showLoginForm'])->name('mobile.login');
Route::post('mobile-login', [CustomLoginController::class, 'login']);
Route::get('/addusers', function () {
    return view('auth.addusers');
})->name('addusers');
Route::get('/addusers/{refer_code?}', [CustomLoginController::class, 'showRegistrationForm'])->name('addusers');

Route::post('/addusers', [CustomLoginController::class, 'register'])->name('addusers');
Route::post('logout', [CustomLoginController::class, 'logout'])->name('logout');
Route::get('/logout', [CustomLoginController::class, 'logout'])->name('logout');
Route::get('/force-change-password', [CustomLoginController::class, 'showChangePasswordForm'])->name('force.change.password');
Route::post('/force-change-password', [CustomLoginController::class, 'changePassword'])->name('force.change.password.post');

Route::get('/password/otp', [OTPResetsController::class, 'showMobileForm'])->name('password.otp');
Route::post('/send-otp', [OTPResetsController::class, 'sendOTP'])->name('send.otp');
Route::post('/verify-otp', [OTPResetsController::class, 'verifyOTP'])->name('verify.otp');
Route::get('/password/reset', [OTPResetsController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/update', [OTPResetsController::class, 'updatePassword'])->name('password.update');

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/profile', [CustomLoginController::class, 'profile'])->name('profile');
Route::put('/profile/update', [CustomLoginController::class, 'updateProfile'])->name('profile.update');

Route::get('/level1List', [UsersController::class, 'level1List'])->name('level_1.index');
Route::get('/level2List', [UsersController::class, 'level2List'])->name('level_2.index');
Route::get('/level3List', [UsersController::class, 'level3List'])->name('level_3.index');
Route::get('/level4List', [UsersController::class, 'level4List'])->name('level_4.index');
Route::get('/news', [NewsController::class, 'invite_friends'])->name('invite_friends.index');
Route::get('/inactive-users', [InactiveUsersController::class, 'index'])->name('inactive_users.index');
Route::post('/inactive-users/activate/{id}', [InactiveUsersController::class, 'activate'])->name('inactive_users.activate');
Route::get('/inactive-users/activates', [InactiveUsersController::class, 'activates'])->name('inactive_users.activates');
Route::get('/inactive-users/activate', [InactiveUsersController::class, 'activate'])->name('inactive_users.activate');
Route::get('/inactive-users/activate-level', [InactiveUsersController::class, 'showActivationPage'])->name('inactive_users.showActivationPage');
Route::get('/transactions', [TransactionsController::class, 'index'])->name('transactions.index');
Route::get('/works', [WorksController::class, 'index'])->name('works.index');
Route::get('/withdrawals', [WithdrawalsController::class, 'index'])->name('withdrawals.index');
Route::resource('withdrawals', WithdrawalsController::class);
Route::resource('my_products', ProductsController::class);
Route::post('/inactive_users/enable', [InactiveUsersController::class, 'enableUser'])->name('inactive_users.enable');
Route::post('/update-refer', [UserController::class, 'updateRefer'])->name('inactive_users.update_refer');
// Route to display the registration form (GET)
Route::get('/inactive-users/create', [InactiveUsersController::class, 'showCreateForm'])->name('inactive_users.create');
Route::get('/get-user-referrals', [UsersController::class, 'getUserReferrals'])->name('getUserReferrals');

// Route to handle form submission (POST)
Route::post('/inactive-users/store', [InactiveUsersController::class, 'create'])->name('inactive_users.store');

Route::get('/extra_bonus', [ExtraBonusController::class, 'index'])->name('extra_bonus.index');
Route::post('/bonus/claim/{level}', [ExtraBonusController::class, 'claim'])->name('bonus.claim');
Route::resource('payment_screenshots', PaymentScreenshotsControllers::class);
Route::get('/bankdetails/update', [BankDetailsController::class, 'showUpdateForm'])->name('bankdetails.update');
Route::post('/bankdetails/update', [BankDetailsController::class, 'update'])->name('bankdetails.update');
Route::post('/bankdetails/update', [BankDetailsController::class, 'update'])->name('bankdetails.update');
Route::get('/withdrawals/show', [WithdrawalsController::class, 'show'])->name('withdrawals.show');
Route::resource('withdrawals', WithdrawalsController::class)->except(['show']);
Route::post('/withdrawals/submit', [WithdrawalsController::class, 'submitWithdrawal'])->name('withdrawals.submit');
Route::get('/inactive-users/get-level-users', [InactiveUsersController::class, 'getLevelUsers'])->name('inactive_users.getLevelUsers');
Route::get('/inactive-users/activateusers', [InactiveUsersController::class, 'activateusers'])->name('inactive_users.activateusers');
Route::get('/news/download/{id}', [NewsController::class, 'downloadImage'])->name('news.download');

Route::get('/about-us', function () {
    return view('about-us');
})->name('about.us');

Route::get('/add_earnings', [EarningsController::class, 'index'])->name('add_earnings.index');


// Handle Image Upload (POST)
Route::post('/works/upload', [WorksController::class, 'uploadImage'])->name('works.upload');
Route::post('/balance/add', [HomeController::class, 'addToBalance'])->name('balance.add');