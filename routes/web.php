<?php

use App\Http\Controllers\Admin\TransactionsController as AdminTransactionsController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\LogsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrasiGaransiController;
use App\Http\Controllers\ClaimGaransiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [MainController::class, 'login'])->name('login');
    Route::get('/register', [MainController::class, 'register'])->name('register');
    Route::get('/forgot-password', [MainController::class, 'forgotPassword'])->name('forgot_password');
    Route::get('/new-password/{token}/{email}', [MainController::class, 'newPassword'])->name('new_password');
    Route::get('/verify/{token}/{email}', [MainController::class, 'verifyAccount'])->name('verify_account');
    Route::get('/reverify', [MainController::class, 'reVerify'])->name('reverify');
});
Route::post('/register', [MainController::class, 'registerAction'])->name('register_submit');
Route::post('/login', [MainController::class, 'loginAction'])->name('login_submit');
Route::post('/forgot-password', [MainController::class, 'forgotPasswordAction'])->name('forgot_password_submit');
Route::post('/new-password', [MainController::class, 'newPasswordAction'])->name('new_password_submit');
Route::post('/reverify', [MainController::class, 'reVerifyAction'])->name('re_verify_submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [MainController::class, 'dashboard'])->name('dashboard');
    Route::get('/logout', [MainController::class, 'logout'])->name('logout');

    /**
     * Profile
     */
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'update')->name('update');
    });

    /**
     * Registrasi Garansi
     */
    Route::controller(RegistrasiGaransiController::class)
        ->middleware('role:User')
        ->prefix('registrasi-garansi')
        ->name('registrasi-garansi.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/form', 'form')->name('form');
            Route::post('/form', 'store')->name('store');
            Route::get('/forms', 'forms')->name('forms');
            Route::get('/{id}/detail', 'detail')->name('detail');
        });

    /**
     * Claim Garansi
     */
    Route::controller(ClaimGaransiController::class)
        ->middleware('role:User')
        ->prefix('claim-garansi')
        ->name('claim-garansi.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/form', 'form')->name('form');
            Route::post('/form', 'store')->name('store');
            Route::get('/forms', 'forms')->name('forms');
            Route::get('/{id}/detail', 'detail')->name('detail');
        });

    /**
     * Admin
     */
    Route::middleware('role:Admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            /**
             * Transactions
             */
            Route::controller(AdminTransactionsController::class)
                ->prefix('transactions')
                ->name('transactions.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/{id}/detail', 'detail')->name('detail');
                    Route::get('/{id}/tolak', 'tolak')->name('tolak');
                    Route::get('/{id}/terima', 'terima')->name('terima');
                    Route::get('/{id}/electrical', 'electrical')->name('electrical');
                });

            /**
             * User List
             */
            Route::controller(AdminUsersController::class)
                ->prefix('users')
                ->name('users.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/store', 'store')->name('store');
                    Route::get('/edit', 'edit')->name('edit');
                    Route::get('/update', 'update')->name('update');
                    Route::get('/destroy', 'destroy')->name('destroy');
                    Route::get('/{id}/progress', 'progress')->name('progress');
                });

            Route::controller(LogsController::class)
                ->prefix('logs')
                ->name('logs.')
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                });
        });
});
