<?php

use App\Http\Controllers\API\v1\DataController;
use App\Services\JsonRpc\JsonRpcServer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| V1 API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for V1.
|
*/

Route::post('/', function (Request $request,
                           JsonRpcServer $server,
                           DataController $controller) {
    return $server->handle($request, $controller);
});
