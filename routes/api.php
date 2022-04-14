<?php

use App\Http\Controllers\CubeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(CubeController::class)->group(function () {

    /**
     * side ('U', 'L', 'F', 'R', 'B', 'D')
     * row (1, 2, 3)
     * direction ('vertical', 'horizontal')
     * degree (90, 180),
     *
     * request example: {host}/api/rotate?side=D&direction=horizontal&degree=90
     */
    Route::get('rotate', 'rotate');
});
