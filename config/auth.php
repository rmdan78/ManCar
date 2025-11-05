<?php

use App\Models\User\User; 

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | Opsi ini mengontrol 'guard' dan 'password' reset default untuk
    | aplikasi Anda. Anda dapat mengubah default ini sesuai kebutuhan.
    |
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Selanjutnya, Anda dapat menentukan setiap 'guard' autentikasi untuk aplikasi Anda.
    | Tentu saja, konfigurasi default yang bagus telah ditentukan
    | di sini yang menggunakan penyimpanan sesi dan provider user Eloquent.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        // Anda bisa menambahkan guard 'api' atau 'sanctum' di sini jika perlu
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Semua driver 'guard' memiliki 'provider' user. Ini mendefinisikan bagaimana
    | user diambil dari penyimpanan persisten Anda.
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', \App\Models\User\User::class), // <-- Menggunakan 'User' dari 'use' di atas
            
            'connection' => 'tenant',
            // ------------------------------------
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Anda dapat menentukan beberapa konfigurasi reset password di sini,
    | tetapi konfigurasi default 'users' sudah cukup baik.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | Di sini Anda dapat menentukan jumlah detik sebelum konfirmasi password
    | habis masa berlakunya dan pengguna diminta untuk memasukkan kembali
    | password mereka melalui layar konfirmasi.
    |
    */

    'password_timeout' => 10800,

];

