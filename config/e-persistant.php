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
        'log' => 'https://epersonal.pertanian.go.id/aktivitas-harian/mlog',
        'login' => 'https://epersonal.pertanian.go.id/login/jumperLogin?key=',
        'profile' => 'https://epersonal.pertanian.go.id/index.php/kinerja-pegawai/dashboard',
        'proxy' => 'https://cors-anywhere.herokuapp.com/',
    ],

    'simasn' => [
        'uri' => [
            'login' => 'http://simasn.pertanian.go.id/simasn/',
            'home' => 'http://simasn.pertanian.go.id/simasn/index.php/user/home_user/'
        ],

        'input' => [
            'loginXpath' => '//*[@id="particles"]/div/div/div[2]/form',
            'name' => [
                'username' => 'username',
                'password' => 'password'
            ]
        ]
    ],

    'form_input' => [
        'id_skp',
        'nip',
        'tanggal',
        'jam_dari',
        'jam_sampai',
        'jenis_tugas',
        'tj[tj_tb_id]',
        'tj[tj_realisasi]',
        'tj[tj_deskripsi]',
        'tj[tj_output]',
    ],

    'encode' => 'https://epersonal.pertanian.go.id/Fitur/encodeId/',

    /*
    |--------------------------------------------------------------------------
    | Price list for application packages
    |--------------------------------------------------------------------------
    |
    */

    'prices' => [
        'expired' => 0,
        'trial' => 0,
        'bulanan' => 15000,
        'tahunan' => (15000 * 12) - ((15000 * 12) * 0.2)
    ],

    'payments_gateway' => [
        'default' => 'midtrans'
    ],

];
