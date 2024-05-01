<?php

use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function (){
    Route::get('login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login');
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
});

Route::middleware('auth')->group(function (){
    Route::get('home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('about', [\App\Http\Controllers\HomeController::class, 'about'])->name('about');
    Route::get('', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::group(['middleware' => ['role:administrator']], function () {
        Route::name('setting-management.')->group(function (){
            Route::get('/setting-management/institution', [\App\Http\Controllers\SettingManagement\InstitutionController::class, 'index'])->name('institution');
            Route::get('/setting-management/period', [\App\Http\Controllers\SettingManagement\PeriodController::class, 'index'])->name('period');
            Route::get('/setting-management/hijri', [\App\Http\Controllers\SettingManagement\HijriController::class, 'index'])->name('hijri');
            Route::post('/setting-management/hijri', [\App\Http\Controllers\SettingManagement\HijriController::class, 'store'])->name('hijri');
            Route::get('/setting-management/asset', [\App\Http\Controllers\SettingManagement\AssetController::class, 'index'])->name('asset');
            Route::post('/setting-management/asset', [\App\Http\Controllers\SettingManagement\AssetController::class, 'store'])->name('asset');
            Route::get('/setting-management/config-domicile', [\App\Http\Controllers\SettingManagement\HijriController::class, 'configDomicile'])->name('config-domicile');
            Route::get('/setting-management/config-diniyah', [\App\Http\Controllers\SettingManagement\HijriController::class, 'configDiniyah'])->name('config-diniyah');
            Route::get('/setting-management/config-formal', [\App\Http\Controllers\SettingManagement\HijriController::class, 'configFormal'])->name('config-formal');
            Route::get('/setting-management/config-registration', [\App\Http\Controllers\SettingManagement\HijriController::class, 'configRegistration'])->name('config-registration');
        });

        Route::name('user-management.')->group(function () {
            Route::get('/user-management/permission', [\App\Http\Controllers\UserManagement\PermissionController::class, 'index'])->name('permission');
            Route::get('/user-management/role', [\App\Http\Controllers\UserManagement\RoleController::class, 'index'])->name('role');
            Route::get('/user-management/user', [\App\Http\Controllers\UserManagement\UserController::class, 'index'])->name('user');
        });
    });

    Route::group(['middleware' => ['role:staff-secretary|staff-treasurer']], function () {
        Route::name('register-management.')->group(function (){
            Route::get('/register-management/guardian', [\App\Http\Controllers\RegisterManagement\GuardianController::class, 'index'])->name('guardian');
            Route::get('/register-management/student', [\App\Http\Controllers\RegisterManagement\StudentController::class, 'index'])->name('student');
            Route::get('/register-management/domicile', [\App\Http\Controllers\RegisterManagement\DomicileController::class, 'index'])->name('domicile');
            Route::get('/register-management/diniyah', [\App\Http\Controllers\RegisterManagement\DiniyahController::class, 'index'])->name('diniyah');
            Route::get('/register-management/formal', [\App\Http\Controllers\RegisterManagement\FormalController::class, 'index'])->name('formal');
            Route::get('/register-management/status', [\App\Http\Controllers\RegisterManagement\StatusController::class, 'index'])->name('status');
            Route::get('/register-management/registration', [\App\Http\Controllers\RegisterManagement\RegistrationController::class, 'index'])->name('registration');
        });
    });

    Route::group(['middleware' => ['role:treasurer|staff-treasurer']], function () {
        Route::name('payment-management.')->group(function (){
            Route::get('/payment-management/account', [\App\Http\Controllers\PaymentManagement\AccountController::class, 'index'])->name('account')->middleware(['permission:create payment management']);
            Route::get('/payment-management/disbursement', [\App\Http\Controllers\PaymentManagement\DisbursementController::class, 'index'])->name('disbursement')->middleware(['permission:create payment management']);;
            Route::get('/payment-management/registration', [\App\Http\Controllers\PaymentManagement\RegistrationController::class, 'index'])->name('registration')->middleware(['permission:create payment management']);;
            Route::get('/payment-management/infaq', [\App\Http\Controllers\PaymentManagement\InfaqController::class, 'index'])->name('infaq')->middleware(['permission:create payment management']);;
            Route::get('/payment-management/pesantren', [\App\Http\Controllers\PaymentManagement\PesantrenController::class, 'index'])->name('pesantren')->middleware(['permission:create payment management']);;
            Route::get('/payment-management/tahfidz', [\App\Http\Controllers\PaymentManagement\TahfidzController::class, 'index'])->name('tahfidz')->middleware(['permission:create payment management']);;
            Route::get('/payment-management/school', [\App\Http\Controllers\PaymentManagement\SchoolController::class, 'index'])->name('school')->middleware(['permission:create payment management']);;
            Route::get('/payment-management/fare', [\App\Http\Controllers\PaymentManagement\FareController::class, 'index'])->name('fare')->middleware(['permission:read payment management']);;
            Route::get('/payment-management/fare/create', [\App\Http\Controllers\PaymentManagement\FareController::class, 'create'])->name('fare.create')->middleware(['permission:create payment management']);;
            Route::post('/payment-management/fare/store', [\App\Http\Controllers\PaymentManagement\FareController::class, 'store'])->name('fare.store')->middleware(['permission:create payment management']);;
            Route::get('/payment-management/payment', [\App\Http\Controllers\PaymentManagement\PaymentController::class, 'index'])->name('payment')->middleware(['permission:read payment management']);;
        });
    });

    Route::name('print.')->group(function (){
        Route::get('/print/student/{id?}', [\App\Http\Controllers\RegisterManagement\StudentController::class, 'print'])->name('student');
        Route::get('/print/payment/{id?}', [\App\Http\Controllers\PaymentManagement\PaymentController::class, 'print'])->name('payment');
    });
});
