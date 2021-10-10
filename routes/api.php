<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('get-times', function (Request $request) {
        $default = $request->default ?? '19:00';
        $interval = $request->interval ?? '+60 minutes';
        // $output = '';
        $output = [];

        $current = strtotime('00:00');
        $end = strtotime('23:59');

        // while ($current <= $end) {
        //     $time = date('H:i', $current);
        //     $sel = ($time == $default) ? ' selected' : '';

        //     $output .= "<option value=\"{$time}\"{$sel}>" . date('H:i', $current) .'</option>';
        //     $current = strtotime($interval, $current);
        // }
        while ($current <= $end) {
            $output[] = date('H:i', $current);
            $current = strtotime($interval, $current);
            // $sel = ($time == $default) ? ' selected' : '';
        }
        return $output;
});
