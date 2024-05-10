<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/member/applicants', function () {
    return view('filament.pages.applicants')->name('Prueba');
});

