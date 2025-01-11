<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ExpenditureController;
use App\Http\Controllers\ExpenditureTypeController;
use App\Http\Controllers\GarageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MotoristController;
use App\Http\Controllers\OutputSparePartController;
use App\Http\Controllers\OutputStationeryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseSpareController;
use App\Http\Controllers\PurchaseStationeryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\StationeryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WordExportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// login
Route::get('/login', [AuthController::class, 'index'])->name('auth.index')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');



Route::group(['middleware' => ['auth']], function() {

    Route::get('/', [HomeController::class,'index'])->name('home');

    // resource garage
    Route::resource('garages', GarageController::class);
    Route::get('/garages/{expensId}/{garageId}', [GarageController::class, 'garageExpens']);
    Route::post('/garages/car-store', [GarageController::class, 'carStore'])->name('garages.car.store');
    Route::post('/garages/driver-store', [GarageController::class, 'driverStore'])->name('garages.driver.store');
    Route::post('/garages/{garage_id}/update-status', [GarageController::class, 'updateStatus'])->name('garages.update.status');

    Route::resource('expenditures', ExpenditureController::class);
    // Route::post('/expenditures/type-store', [ExpenditureController::class, 'typeStore'])->name('expenditures.type.store');
    Route::resource('expenditure-types', ExpenditureTypeController::class);
    
    Route::resource('users', UserController::class);
    Route::post('/users/key/{user}', [UserController::class, 'key'])->name('users.key');
    Route::resource('roles', RoleController::class);

    Route::resource('drivers', DriverController::class);
    Route::get('/getDriver/{id}', [DriverController::class, 'getDriver']);
    Route::resource('services', ServiceController::class);
    Route::resource( 'products', ProductController::class);
    Route::resource( 'purchases', PurchaseController::class);
    
    Route::resource('motorists', MotoristController::class);
    Route::post('/motorists/{motorist_id}/update-status', [MotoristController::class, 'updateStatus'])->name('motorists.update.status');

    Route::resource( 'clients', ClientController::class);
    Route::resource( 'suppliers', SupplierController::class);

    Route::resource( 'branches', BranchController::class);
    Route::get('/branches/getEmployee/{id}', [BranchController::class, 'getEmployee']);
    Route::get('/branches/getGarages/{id}', [BranchController::class, 'getGarages']);

    Route::resource( 'spare-part', SparePartController::class);
    Route::resource( 'purchase-spare-part', PurchaseSpareController::class);
    // getProductPrice
    Route::get('/spare-part/get-product-price/{productId}', [PurchaseSpareController::class, 'getProductPrice']);
    
    Route::resource( 'stationery', StationeryController::class);
    Route::resource( 'purchase-stationery', PurchaseStationeryController::class);
    Route::get('/stationery/get-product-price/{productId}', [PurchaseStationeryController::class, 'getProductPrice']);
    
    Route::resource( 'output-stationery', OutputStationeryController::class);
    Route::get('/output-stationery/quantity-stationery/{stationeryId}', [OutputStationeryController::class, 'quanStationery']);
    Route::resource( 'output-spare-part', OutputSparePartController::class);
    Route::get('/output-spare-part/search', [OutputSparePartController::class, 'search'])->name('output-spare-part.search');
    
    Route::get('/output-spare-part/quantity-spare-part/{sparePartId}', [OutputSparePartController::class, 'quanSparePart']);

    
    Route::resource( 'services', ServiceController::class);
    Route::resource( 'contracts', ContractController::class);
    Route::get('/contracts/get-service-price/{serviceId}', [ContractController::class, 'getServicePrice']); 
    Route::get('/contracts-search', [ContractController::class, 'search'])->name('contracts.search');
    Route::get('/contracts-details', [ContractController::class, 'details'])->name('contracts.details');



    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/password/update/{id}', [ProfileController::class, 'passwordUpdate'])->name('password.update');



    Route::get('/export-word', [WordExportController::class, 'exportToWord']);

    Route::get('/generate-pdf/{id}', [App\Http\Controllers\ContractController::class, 'generatePDF'])->name('contracts.pdf');
    });
