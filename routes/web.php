<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $this->response = Http::withBasicAuth('webservice', '123456Aa');
    $url = "http://78.40.109.119/KMO/hs/app/calculateprice/2fb37215-4eb5-11ec-9410-c2e43491cb6b/20220704/1/1/1/1/1/122/1/1/1/1/1/1/0/0/0/0/0/0";
    $response = $this->response->get($url);
    $data = json_decode($response->body(),flags: JSON_OBJECT_AS_ARRAY);
});
