<?php

return [

	/*
    |--------------------------------------------------------------------------
    | Mapping uri in entire application
    |--------------------------------------------------------------------------
    |
    | Semua kebutuhan uri dsimpan di dalam config ini agar memudahkan
    | maintenance dan memperbarui uri apabila ada pergantian
    | uri dari aplikasi e-personal.
    |
    */

	'uri' => [
        'log' => 'http://ekinerja.pertanian.go.id/epersonalv2/ekinerjav2/mlog/index.php',
        'addActivity' => 'http://ekinerja.pertanian.go.id/epersonalv2/mpribadi/add2.php',
        'login' => 'http://ekinerja.pertanian.go.id/epersonalv2/index.php',
        'profile' => 'http://ekinerja.pertanian.go.id/epersonalv2/mpribadi/index.php',
    ],

    /*
    |--------------------------------------------------------------------------
    | Price list for application packages
    |--------------------------------------------------------------------------
    |
    */

    'prices' => [
        'expired' => 0,
        'trial' => 0,
        'bulanan' => 25000,
        'tahunan' => (25000 * 12) - ((25000 * 12) * 0.2)
    ],

];
