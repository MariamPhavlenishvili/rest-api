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

Route::post('/v1/playlists', [App\Http\Controllers\playlistController::class, 'createPlaylists']);
Route::post('/v1/playlists/{id}', [App\Http\Controllers\playlistController::class, 'addMusic']);
Route::delete('/v1/playlists/{playlistId}', [App\Http\Controllers\playlistController::class, 'deletePlaylist']);
Route::delete('/v1/playlists/music/{musicId}', [App\Http\Controllers\playlistController::class, 'deleteMusic']);
Route::get('/v1/playlists/', [App\Http\Controllers\playlistController::class, 'getAllPlaylists']);
Route::get('/v1/playlists/musics/', [App\Http\Controllers\playlistController::class, 'getAllMusic']);

