<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmsApiController;
use App\Http\Controllers\SmstitleoperatorsController;


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
Route::post('ysearch',[SmsApiController::class,'ysearch']);
Route::post('dsearch',[SmsApiController::class,'dsearch']);
Route::get('yearlyreportexport', [SmsApiController::class, 'yearlyreportexport']);
Route::get('yearlysearchreportexport', [SmsApiController::class, 'yearlysearchreportexport']);

Route::get('smstitleoperatorsrefresh', [SmstitleoperatorsController::class, 'smstitleoperatorsrefresh']);
