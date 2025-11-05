<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Web\Auth;
use App\Http\Controllers\Web\Dashboard;
use App\Http\Controllers\Web\Profile;
use App\Http\Controllers\Web\User;
use App\Http\Controllers\Web\Vehicle;


/*
|--------------------------------------------------------------------------
| Rute Landlord / Pusat
|--------------------------------------------------------------------------
|
| Rute ini TIDAK akan menggunakan middleware 'tenant'.
| Ini adalah rute untuk website utama Anda, pendaftaran perusahaan baru, dll.
| (Anda bisa tambahkan nanti)
|
| Contoh: Route::get('/', [LandingPageController::class, 'index']);
|
*/


/*
|--------------------------------------------------------------------------
| Rute Aplikasi Tenant
|--------------------------------------------------------------------------
|
| Semua rute di bawah ini akan otomatis:
| 1. Menjalankan middleware 'web' (session, cookie, CSRF)
| 2. Menjalankan middleware 'tenant' (identifikasi subdomain & ganti DB)
|
*/
Route::middleware(['web', 'tenant']) // <-- KUNCI UTAMA DI SINI
    ->group(function () {

    Route::get('/', fn() => redirect()->route('dashboard'));

    /**
     * AUTH
     */
    Route::middleware(['guest'])->prefix('/auth')->group(function() {
        Route::prefix('/signIn')->group(function() {
            Route::get('/', [Auth\SignInController::class, 'index'])->name('signIn');
            Route::post('/', [Auth\SignInController::class, 'store'])->name('signIn.post');
        });
    });



    /**
     * AUTHENTICATED ROUTES
     */
    Route::middleware('auth')->group(function() {
        /**
         * AUTH
         */
        Route::prefix('/auth')->group(function() {
            Route::prefix('/signOut')->group(function() {
                Route::delete('/', [Auth\SignOutController::class, 'destroy'])->name('signOut.delete');
            });
        });

        /**
         * DASHBOARD
         */
        Route::prefix('/dashboard')->name('dashboard')->group(function() {
            Route::get('/', [Dashboard\DashboardController::class, 'index']);
            Route::get('/api/transactions', [Dashboard\DashboardController::class, 'apiTransactions'])->name('dashboard.apiTransactions'); // Perbaikan: Nama rute lebih baik unik
        });


        /**
         * PROFILE
         */
        Route::prefix('/profile')->name('profile.')->group(function() {
            Route::singleton('/', Profile\ProfileController::class);

            // PROFILE/PASSWORD
            Route::singleton('/password', Profile\PasswordController::class)->except('show');
        });


        /**
         * VEHICLES
         */
        Route::prefix('/vehicles')
            ->name('vehicles')
            ->controller(Vehicle\VehicleController::class)
            ->group(function() {

            Route::get('/', 'index');
            Route::post('/', 'store')->name('.post');
            Route::get('/create', 'create')->name('.create');

            // VEHICLES/TRANSACTIONS
            Route::prefix('/transactions')
                ->name('.transactions')
                ->controller(Vehicle\Transaction\TransactionController::class)
                ->group(function() {

                Route::get('/', 'index');
                Route::post('/', 'store')->name('.post');
                Route::get('/export', 'export')->name('.export');
                Route::get('/create', 'create')->name('.create');
                Route::patch('/approves', 'approves')->name('.approves.patch');
                Route::patch('/rejects', 'rejects')->name('.rejects.patch');
                Route::patch('/completes', 'completes')->name('.completes.patch');

                // VEHICLES/TRANSACTIONS/BY_REQUEST_ID
                Route::prefix('/{transactionId}')->name('.byTransactionId')->group(function() {
                    Route::get('/', 'show');
                    Route::put('/', 'update')->name('.put');
                    Route::delete('/', 'destroy')->name('.delete');
                    Route::get('/edit', 'edit')->name('.edit');
                });
            });

            // VEHICLES/BY_VEHICLE_ID
            Route::prefix('/{vehicleId}')->name('.byVehicleId')->group(function() {
                Route::get('/', 'show');
                Route::put('/', 'update')->name('.put');
                Route::delete('/', 'destroy')->name('.delete');
                Route::get('/edit', 'edit')->name('.edit');
            });
        });


        /**
         * USERS
         */
        Route::prefix('/users')
            ->name('users')
            ->controller(User\UserController::class)
            ->group(function() {

            Route::get('/', 'index');
            Route::post('/', 'store')->name('.post');
            Route::get('/create', 'create')->name('.create');
            Route::patch('/disables', 'disables')->name('.disables');
            Route::patch('/recovers', 'recovers')->name('.recovers');

            // VEHICLES/TRANSACTIONS/BY_REQUEST_ID
            Route::prefix('/{userId}')->name('.byUserId')->group(function() {
                Route::get('/', 'show');
                Route::put('/', 'update')->name('.put');
                Route::delete('/', 'destroy')->name('.delete');
                Route::get('/edit', 'edit')->name('.edit');
            });
        });
    });
});
