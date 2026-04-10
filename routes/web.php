<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Psy\Command\WhereamiCommand;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', function () {
    $familia_profesional_id = DB::table('familias_profesionales')->pluck('id','codigo');
    $ciclo_formativo_id= DB::table('ciclos_formativos')->pluck('id','codigo');

    return $ciclo_formativo_id;
});
