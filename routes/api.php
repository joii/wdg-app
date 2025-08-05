<?php

use App\Http\Controllers\Backend\PawnOnlineTransactionController;
use App\Http\Controllers\WebAPI\CustomerDataController;
use App\Http\Controllers\WebAPI\PawnAddDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAPI\PawnDataController;
use App\Http\Controllers\WebAPI\PawnInterestDataController;
use App\Http\Controllers\WebAPI\PawnSub100MDataController;
use App\Http\Controllers\WebAPI\PawnSub100NMDataController;
use App\Http\Controllers\WebAPI\PawnSubNMDataController;
use App\Http\Controllers\WebAPI\PawnManagementController;
use App\Http\Controllers\WebAPI\PawnSendInterestDataController;
use App\Http\Controllers\WebAPI\PawnOnlineTransactionManagementController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('pawn-data')->group(function () {
    //Route::post('/import/record', [PawnDataController::class, 'importRecord']);
    Route::get('/import/record', [PawnDataController::class, 'importRecord']);
    Route::get('/', [PawnDataController::class, 'getPawnDataRecords']);
});

Route::prefix('pawn-sub100m-data')->group(function () {
    Route::post('/import/record', [PawnSub100MDataController::class, 'importRecord']);
    Route::get('/', [PawnSub100MDataController::class, 'getPawnSub100mDataRecords']);
});

Route::prefix('pawn-sub100nm-data')->group(function () {
    //Route::post('/import/record', [PawnSub100NMDataController::class, 'importRecord']);
    Route::get('/import/record', [PawnSub100NMDataController::class, 'importRecord']);
    Route::get('/', [PawnSub100NMDataController::class, 'getPawnSub100nmDataRecords']);
});

Route::prefix('pawn-subnm-data')->group(function () {
    //Route::post('/import/record', [PawnSubNMDataController::class, 'importRecord']);
    Route::get('/import/record', [PawnSubNMDataController::class, 'importRecord']);
    Route::get('/', [PawnSubNMDataController::class, 'getPawnSubnmDataRecords']);
});

Route::prefix('pawn_add_data')->group(function () {
   // Route::post('/import/record', [PawnAddDataController::class, 'importRecord']);
    Route::get('/import/record', [PawnAddDataController::class, 'importRecord']);
    Route::get('/', [PawnAddDataController::class, 'getPawnAddDataRecords']);
});

Route::prefix('pawn-interest-data')->group(function () {
    //Route::post('/import/record', [PawnInterestDataController::class, 'importRecord']);
    Route::get('/import/record', [PawnInterestDataController::class, 'importRecord']);
    Route::get('/', [PawnInterestDataController::class, 'getPawnInterestDataRecords']);
});

Route::prefix('customer-data')->group(function () {
   // Route::post('/import/record', [CustomerDataController::class, 'importRecord']);
    Route::get('/import/record', [CustomerDataController::class, 'importRecord']);
    Route::get('/', [CustomerDataController::class, 'getCustomersRecords']);
   // Route::post('/import', [ImportCustomerController::class, 'import']);

});

Route::prefix('pawn-send-interest-data')->group(function () {
    //Route::post('/import/record', [PawnSendInterestDataController::class, 'importRecord']);
    Route::get('/import/record', [PawnSendInterestDataController::class, 'importRecord']);
    Route::get('/', [PawnSendInterestDataController::class, 'getPawnSendInterestDataRecords']);
});



// Clone data from pawn_data to pawns table
Route::prefix('pawns')->group(function () {
   Route::post('/create', [PawnManagementController::class,'create']);
});

Route::get('/export-pawn-transactions', [PawnOnlineTransactionManagementController::class, 'exportPawnTransactionsToCsv'])->name('export_pawn_transactions');



