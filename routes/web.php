<?php

use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function (){
    Route::get('login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login');
    Route::post('login', [\App\Http\Controllers\AuthController::class, 'login']);
});

Route::middleware('auth')->group(function (){
    Route::get('home', \App\Http\Controllers\HomeController::class)->name('home');
    Route::get('', \App\Http\Controllers\HomeController::class)->name('home');
    Route::post('logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    //UTILITIES
    Route::get('about', \App\Http\Controllers\Utilities\AboutController::class)->name('about');
    Route::get('account', [\App\Http\Controllers\Utilities\AccountController::class, 'index'])->name('account');
    Route::post('change-email', [\App\Http\Controllers\Utilities\AccountController::class, 'changeEmail'])->name('change-email');
    Route::post('change-password', [\App\Http\Controllers\Utilities\AccountController::class, 'changePassword'])->name('change-password');

    Route::group(['middleware' => ['role:administrator']], function () {
        Route::name('setting-management.')->group(function (){
            Route::get('/setting-management/institution', [\App\Http\Controllers\SettingManagement\InstitutionController::class, 'index'])->name('institution');
            Route::get('/setting-management/period', [\App\Http\Controllers\SettingManagement\PeriodController::class, 'index'])->name('period');
            Route::get('/setting-management/hijri', [\App\Http\Controllers\SettingManagement\HijriController::class, 'index'])->name('hijri');
            Route::post('/setting-management/hijri', [\App\Http\Controllers\SettingManagement\HijriController::class, 'store'])->name('hijri');
            Route::get('/setting-management/asset', [\App\Http\Controllers\SettingManagement\AssetController::class, 'index'])->name('asset');
            Route::post('/setting-management/asset', [\App\Http\Controllers\SettingManagement\AssetController::class, 'store'])->name('asset');
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
            Route::get('/register-management/guardian-export', [\App\Http\Controllers\RegisterManagement\GuardianController::class, 'export'])->name('guardian-export');
            Route::get('/register-management/student', [\App\Http\Controllers\RegisterManagement\StudentController::class, 'index'])->name('student');
            Route::get('/register-management/student-export', [\App\Http\Controllers\RegisterManagement\StudentController::class, 'export'])->name('student-export');
            Route::get('/register-management/domicile', [\App\Http\Controllers\RegisterManagement\DomicileController::class, 'index'])->name('domicile');
            Route::get('/register-management/diniyah', [\App\Http\Controllers\RegisterManagement\DiniyahController::class, 'index'])->name('diniyah');
            Route::get('/register-management/formal', [\App\Http\Controllers\RegisterManagement\FormalController::class, 'index'])->name('formal');
            Route::get('/register-management/status', [\App\Http\Controllers\RegisterManagement\StatusController::class, 'index'])->name('status');
            Route::get('/register-management/registration', [\App\Http\Controllers\RegisterManagement\RegistrationController::class, 'index'])->name('registration');
            Route::get('/register-management/registration-export', [\App\Http\Controllers\RegisterManagement\RegistrationController::class, 'export'])->name('registration-export');
        });
    });

    Route::group(['middleware' => ['role:staff-secretary']], function () {
        Route::name('licensing-management.')->group(function (){
            Route::get('/licensing-management/configuration', [\App\Http\Controllers\LicensingManagement\ConfigurationController::class, 'index'])->name('configuration');
            Route::post('/licensing-management/configuration', [\App\Http\Controllers\LicensingManagement\ConfigurationController::class, 'store'])->name('configuration-store');
            Route::get('/licensing-management/petition', [\App\Http\Controllers\LicensingManagement\PetitionController::class, 'index'])->name('petition');
            Route::get('/licensing-management/license', [\App\Http\Controllers\LicensingManagement\LicenseController::class, 'index'])->name('license');
            Route::get('/licensing-management/comeback', [\App\Http\Controllers\LicensingManagement\ComebackController::class, 'index'])->name('comeback');
            Route::get('/licensing-management/recapitulation', [\App\Http\Controllers\LicensingManagement\RecapitulationController::class, 'index'])->name('recapitulation');
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
            Route::get('/payment-management/fare-export', [\App\Http\Controllers\PaymentManagement\FareController::class, 'export'])->name('fare-export')->middleware(['permission:read payment management']);;
            Route::get('/payment-management/fare/create', [\App\Http\Controllers\PaymentManagement\FareController::class, 'create'])->name('fare.create')->middleware(['permission:create payment management']);;
            Route::post('/payment-management/fare/store', [\App\Http\Controllers\PaymentManagement\FareController::class, 'store'])->name('fare.store')->middleware(['permission:create payment management']);;
            Route::get('/payment-management/reduction', [\App\Http\Controllers\PaymentManagement\ReductionController::class, 'index'])->name('reduction')->middleware(['permission:read payment management']);;
            Route::get('/payment-management/distribution', [\App\Http\Controllers\PaymentManagement\DistributionController::class, 'index'])->name('distribution')->middleware(['permission:read payment management']);;
            Route::get('/payment-management/payment', [\App\Http\Controllers\PaymentManagement\PaymentController::class, 'index'])->name('payment')->middleware(['permission:read payment management']);;
            Route::get('/payment-management/recapitulation', [\App\Http\Controllers\PaymentManagement\RecapitulationController::class, 'index'])->name('recapitulation')->middleware(['permission:read payment management']);
            Route::post('/payment-management/export', [\App\Http\Controllers\PaymentManagement\RecapitulationController::class, 'export'])->name('recapitulation-export')->middleware(['permission:read payment management']);;
        });
    });

    Route::name('print.')->group(function (){
        Route::get('/print/student/{id?}', [\App\Http\Controllers\RegisterManagement\StudentController::class, 'print'])->name('student');
        Route::get('/print/payment/{id?}', [\App\Http\Controllers\PaymentManagement\PaymentController::class, 'print'])->name('payment');
        Route::get('/print/petition/{id?}', [\App\Http\Controllers\LicensingManagement\PetitionController::class, 'print'])->name('petition');
        Route::get('/print/license/{id?}', [\App\Http\Controllers\LicensingManagement\LicenseController::class, 'print'])->name('license');
    });
});
