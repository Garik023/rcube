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

Route::controller(CubeController::class)
    ->prefix('cube')
    ->as('cube.')
    ->group(function () {

    /**
     * Get Rotated cube
     *
     * @method {get}
     *
     * @requestExample: {host}/api/cube/
     */
    Route::get('/', 'index')->name('rotated');

    /**
     * Get Initial cube
     *
     * @method {get}
     *
     * @requestExample: {host}/api/cube/initial
     */
    Route::get('initial', 'initial')->name('initial');

    /**
     * Rotate cube
     *
     * @method {post}
     *
     * @param 'side' @values ('U', 'L', 'F', 'R', 'B', 'D')
     * @param 'direction' @values ('vertical', 'horizontal')
     * @param 'degree' @values (90, 180),
     *
     * @requestExample: {host}/api/cube/rotate
     */
    Route::post('rotate', 'rotate')->name('rotate');
});
