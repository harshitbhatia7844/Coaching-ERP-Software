<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CentreController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RazorpayController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Group;



Route::view('/', 'welcome')->name('welcome');

Route::fallback(function () { return view('/404'); });

// Route for Student starts here
Route::prefix('/student')->name('student.')
    ->controller(StudentController::class)->group(function () {

        Route::middleware('auth:student')->group(function () {

            Route::get('/', 'dashboard')->name('index');
            Route::get('/', 'dashboard')->name('dashboard');
            Route::get('/wallet', 'wallet')->name('wallet');
            Route::get('/profile', 'profile')->name('profile');
            Route::get('/fees', 'fees')->name('fees');
            Route::get('/present', 'present')->name('present');
            Route::get('/paynow', 'paynow')->name('paynow');
            Route::get('/batch', 'batch')->name('batch');
            Route::get('/mycourse', 'mycourse')->name('mycourse');
            Route::get('/viewcourse', 'viewcourse')->name('viewcourse');
            Route::get('/notification', 'notification')->name('notification');
            Route::get('/attendance', 'attendance')->name('attendance');
            Route::post('/withdraw', 'withdraw')->name('withdraw');
            Route::post('/paynow1', 'paynow1')->name('paynow1');
            Route::view('/404', 'student.404')->name('404');
        });

        Route::view('/login', 'student.login')->name('login');
        Route::post('/signin', 'authenticate')->name('signin');
        Route::get('/logout', 'logout')->name('logout');
    });
// Route for Student ends here


// Route for Centre starts here
Route::prefix('/centre')->name('centre.')
    ->controller(CentreController::class)->group(function () {

        Route::middleware('auth:centre')->group(function () {

            Route::get('/', 'dashboard')->name('index');
            Route::get('/', 'dashboard')->name('dashboard');
            Route::get('/profile', 'profile')->name('profile');
            Route::get('/addbranch', 'addbranch')->name('addbranch');
            Route::get('/wallet', 'wallet')->name('wallet');
            Route::get('/viewbatch', 'viewbatch')->name('viewbatch');
            Route::get('/notification', 'notification')->name('notification');
            Route::get('/viewactivity', 'viewactivity')->name('viewactivity');
            Route::get('/viewcourse', 'viewcourse')->name('viewcourse');
            Route::get('/viewstudent', 'viewstudent')->name('viewstudents');
            Route::get('/viewbranch', 'viewbranch')->name('viewbranch');
            Route::get('/createactivity', 'createactivity')->name('createactivity');
            Route::any('/attendance', 'attendance')->name('attendance');
            Route::post('/withdraw', 'withdraw')->name('withdraw');
            Route::post('/store', 'store')->name('store');
            Route::post('/addactivity', 'addactivity')->name('addactivity');
            Route::post('/addbatch', 'addbatch')->name('addbatch');
            Route::post('/addnotification', 'addnotification')->name('addnotification');
            Route::post('/addcourse', 'addcourse')->name('addcourse');
            Route::post('/paynow', 'paynow')->name('paynow');
            Route::post('/paynow1', 'paynow1')->name('paynow1');
            Route::view('/createstudent', 'centres.createstudent')->name('createstudent');
            Route::view('/createbatch', 'centres.createbatch')->name('createbatch');
            Route::view('/createcourse', 'centres.createcourse')->name('createcourse');
            Route::view('/createbranch', 'centres.createbranch')->name('createbranch');
            Route::view('/createnotification', 'centres.createnotification')->name('createnotification');
            Route::view('/404', 'centres.404')->name('404');
        });

        Route::view('/forgotpassword', 'centres.forgot-password')->name('forgotpassword');
        Route::view('/register', 'centres.register')->name('register');
        Route::view('/login', 'centres.login')->name('login');
        Route::post('/signin', 'authenticate')->name('signin');
        Route::post('/signup', 'signup')->name('signup');
        Route::post('/reset', 'reset')->name('reset');
        Route::get('/logout', 'logout')->name('logout');
    });
// Route for Centre ends here


// Route for Admin starts here
Route::prefix('/admin')->name('admin.')
    ->controller(AdminController::class)->group(function () {

        Route::middleware('auth:admin')->group(function () {

            Route::get('/', 'dashboard')->name('index');
            Route::get('/', 'dashboard')->name('dashboard');
            Route::get('/profile', 'profile')->name('profile');
            Route::get('/viewactivity', 'viewactivity')->name('viewactivity');
            Route::get('/viewcentre', 'viewcentre')->name('viewcentre');
            Route::get('/viewbranch', 'viewbranch')->name('viewbranch');
            Route::get('/createactivity', 'createactivity')->name('createactivity');
            Route::post('/store', 'store')->name('store');
            Route::post('/addactivity', 'addactivity')->name('addactivity');
            Route::post('/addbranch', 'addbranch')->name('addbranch');
            Route::view('/createcentre', 'admin.createcentre')->name('createcentre');
            Route::view('/createbranch', 'admin.createbranch')->name('createbranch');
            Route::view('/404', 'admin.404')->name('404');
        });

        Route::view('/forgotpassword', 'admin.forgot-password')->name('forgotpassword');
        Route::view('/register', 'admin.register')->name('register');
        Route::view('/login', 'admin.login')->name('login');
        Route::post('/signin', 'authenticate')->name('signin');
        Route::post('/signup', 'signup')->name('signup');
        Route::post('/reset', 'reset')->name('reset');
        Route::get('/logout', 'logout')->name('logout');
    });
// Route for Admin ends here

// Razorpay payment Route 
Route::name('razorpay.')
    ->controller(RazorpayController::class)
    ->prefix('razorpay')
    ->group(function () {
        Route::post('handle-payment', 'handlePayment')->name('make.payment');
    });