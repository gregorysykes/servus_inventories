<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\RejectController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PackagingController;
use App\Http\Controllers\ReportController;

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
    return redirect('/transaction');
});

//item routes
Route::middleware(['auth:sanctum', 'verified'])->get('/item', [ItemController::class, 'index'])->name('item');
Route::middleware(['auth:sanctum', 'verified'])->get('/getAllItems', [ItemController::class, 'getAllItems'])->name('getAllItems');
Route::middleware(['auth:sanctum', 'verified'])->post('/add-item', [ItemController::class, 'add'])->name('add-item');
Route::middleware(['auth:sanctum', 'verified'])->post('/update-item', [ItemController::class, 'update'])->name('update-item');
Route::middleware(['auth:sanctum', 'verified'])->post('/delete-item', [ItemController::class, 'delete'])->name('delete-item');

Route::middleware(['auth:sanctum', 'verified'])->get('/transaction', [TransactionController::class, 'index'])->name('transaction');
Route::middleware(['auth:sanctum', 'verified'])->post('/add-transaction', [TransactionController::class, 'add'])->name('add-transaction');
Route::middleware(['auth:sanctum', 'verified'])->post('/set-claim', [TransactionController::class, 'claim'])->name('set-claim');
Route::middleware(['auth:sanctum', 'verified'])->post('/cancel-transaction', [TransactionController::class, 'cancel'])->name('cancel-transaction');

// stocks
Route::middleware(['auth:sanctum', 'verified'])->get('/stock', [StockController::class, 'index'])->name('stock');
Route::middleware(['auth:sanctum', 'verified'])->post('/add-stock', [StockController::class, 'add'])->name('add-stock');

//process
Route::middleware(['auth:sanctum', 'verified'])->post('/process', [ProcessController::class, 'process'])->name('process');
Route::middleware(['auth:sanctum', 'verified'])->post('/process-packing', [PackagingController::class, 'packing'])->name('process-packing');
//rejects
Route::middleware(['auth:sanctum', 'verified'])->post('/add-reject', [ProcessController::class, 'addReject'])->name('add-reject');

//rejects
Route::middleware(['auth:sanctum', 'verified'])->get('/rejects', [RejectController::class, 'index'])->name('rejects');
Route::middleware(['auth:sanctum', 'verified'])->post('/delete-reject', [RejectController::class, 'delete'])->name('delete-reject');
Route::middleware(['auth:sanctum', 'verified'])->post('/update-reject', [RejectController::class, 'update'])->name('update-reject');
// Route::middleware(['auth:sanctum', 'verified'])->post('/rejects', [PackagingController::class, 'rejects'])->name('rejects');

//state
Route::middleware(['auth:sanctum', 'verified'])->get('/state', [StateController::class, 'index'])->name('state');
Route::middleware(['auth:sanctum', 'verified'])->post('/add-state', [StateController::class, 'add'])->name('add-state');
Route::middleware(['auth:sanctum', 'verified'])->post('/update-state', [StateController::class, 'update'])->name('update-state');
Route::middleware(['auth:sanctum', 'verified'])->post('/delete-state', [StateController::class, 'delete'])->name('delete-state');

//team
Route::middleware(['auth:sanctum', 'verified'])->get('/team', [TeamController::class, 'index'])->name('team');
Route::middleware(['auth:sanctum', 'verified'])->post('/add-team', [TeamController::class, 'add'])->name('add-team');
Route::middleware(['auth:sanctum', 'verified'])->post('/delete-team', [TeamController::class, 'delete'])->name('delete-team');
Route::middleware(['auth:sanctum', 'verified'])->post('/update-team', [TeamController::class, 'update'])->name('update-team');

//user
Route::middleware(['auth:sanctum', 'verified'])->get('/user', [UserController::class, 'index'])->name('user');
Route::middleware(['auth:sanctum', 'verified'])->post('/add-user', [UserController::class, 'index'])->name('add-user');
Route::middleware(['auth:sanctum', 'verified'])->post('/delete-user', [UserController::class, 'index'])->name('delete-user');
Route::middleware(['auth:sanctum', 'verified'])->post('/update-user', [UserController::class, 'index'])->name('update-user');

//packaging
Route::middleware(['auth:sanctum', 'verified'])->get('/packaging', [PackagingController::class, 'index'])->name('packaging');
Route::middleware(['auth:sanctum', 'verified'])->get('/getProcesses', [PackagingController::class, 'getProcesses'])->name('getProcesses');
Route::middleware(['auth:sanctum', 'verified'])->post('/update-packaging', [PackagingController::class, 'update'])->name('update-packaging');
Route::middleware(['auth:sanctum', 'verified'])->post('/cancel-packaging', [PackagingController::class, 'cancel'])->name('cancel-packaging');
Route::middleware(['auth:sanctum', 'verified'])->post('/add-packaging', [PackagingController::class, 'add'])->name('add-packaging');

//dashboard
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard/dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->get('/report', [ReportController::class, 'index'])->name('report');
Route::middleware(['auth:sanctum', 'verified'])->get('/incomingExcel/{mo}', [ReportController::class, 'incomingExcel'])->name('incoming-excel');
Route::middleware(['auth:sanctum', 'verified'])->get('/outgoingExcel/{mo}', [ReportController::class, 'outgoingExcel'])->name('outgoing-excel');