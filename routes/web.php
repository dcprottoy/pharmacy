<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\StoreLocationController;
use App\Http\Controllers\Backend\ProductTypeController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\ProductSubCategoriesController;
use App\Http\Controllers\Backend\MedicineUsageController;
use App\Http\Controllers\Backend\MedicineTypeController;
use App\Http\Controllers\Backend\ManufacturerController;
use App\Http\Controllers\Backend\MedecineController;
use App\Http\Controllers\Backend\OtherProductsController;
use App\Http\Controllers\Backend\StockEntryController;
use App\Http\Controllers\Backend\MrrController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\MedecineStockController;
use App\Http\Controllers\Backend\StockMedecineController;
use App\Http\Controllers\Backend\SalesController;
use App\Http\Controllers\Auth\AuthenticationController;

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
use App\Http\Controllers\PDFController;

Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);


    Route::get('login',[UserController::class,'index'])->name('login');
    Route::post('login',[AuthenticationController::class,'login'])->name('login.post');
    Route::get('logout',[AuthenticationController::class,'logout'])->name('logout.get');
    Route::get('register',[UserController::class,'create']);
    Route::post('register',[UserController::class,'store'])->name('register');



    Route::middleware(['auth'])->group(function () {

        Route::get('/',function(){
            return view('backend.welcome');
        })->name('home');



    Route::put('/stock_locations',[StoreLocationController::class,'search'])->name('store_locations.search');

    Route::resource('/storelocation',StoreLocationController::class)->names([
        'index'=>'storelocation.home',
        'create'=>'storelocation.create',
        'store'=>'storelocation.save',
        'edit'=>'storelocation.edit',
        'update'=>'storelocation.update',
        'destroy'=>'storelocation.delete'
    ]);

    Route::resource('/producttype',ProductTypeController::class)->names([
        'index'=>'producttype.home',
        'create'=>'producttype.create', 
        'store'=>'producttype.save',
        'edit'=>'producttype.edit',
        'update'=>'producttype.update',
        'destroy'=>'producttype.delete'
    ]);
    Route::get('/productcategory/listbytype/{id}',[ProductCategoryController::class,'subList'])->name('productcategory.categorylist');

    Route::resource('/productcategory',ProductCategoryController::class)->names([
        'index'=>'productcategory.home',
        'create'=>'productcategory.create',
        'store'=>'productcategory.save',
        'edit'=>'productcategory.edit',
        'update'=>'productcategory.update',
        'destroy'=>'productcategory.delete'
    ]);
    Route::get('/productsubcategory/listbycategory/{id}',[ProductSubCategoriesController::class,'subList'])->name('productsubcategory.sublist');

    Route::resource('/productsubcategory',ProductSubCategoriesController::class)->names([
        'index'=>'productsubcategory.home',
        'create'=>'productsubcategory.create',
        'store'=>'productsubcategory.save',
        'edit'=>'productsubcategory.edit',
        'update'=>'productsubcategory.update',
        'destroy'=>'productsubcategory.delete'
    ]);

    Route::resource('/medicineusage',MedicineUsageController::class)->names([
        'index'=>'medicineusage.home',
        'create'=>'medicineusage.create',
        'store'=>'medicineusage.save',
        'edit'=>'medicineusage.edit',
        'update'=>'medicineusage.update',
        'destroy'=>'medicineusage.delete'
    ]);

    Route::put('/medecine',[MedecineController::class,'search']);
    Route::put('/medicinefrombank',[MedecineController::class,'medicineFromBank']);
    Route::get('/medicineinfobank/{id}',[MedecineController::class,'medicineinfoBank']);
    Route::get('/medecine/productInfo/{id}',[MedecineController::class,'productInfo']);

    Route::resource('/medecine',MedecineController::class)->names([
        'index'=>'medecine.home',
        'create'=>'medecine.create',
        'store'=>'medecine.save',
        'edit'=>'medecine.edit',
        'update'=>'medecine.update',
        'destroy'=>'medecine.delete'
    ]);

    Route::resource('/otherproducts',OtherProductsController::class)->names([
        'index'=>'otherproducts.home',
        'create'=>'otherproducts.create',
        'store'=>'otherproducts.save',
        'edit'=>'otherproducts.edit',
        'update'=>'otherproducts.update',
        'destroy'=>'otherproducts.delete'
    ]);


    Route::resource('/stockentry',StockEntryController::class)->names([
        'index'=>'stockentry.home',
        'create'=>'stockentry.create',
        'store'=>'stockentry.save',
        'edit'=>'stockentry.edit',
        'update'=>'stockentry.update',
        'destroy'=>'stockentry.delete'
    ]);



    Route::resource('/sales',SalesController::class)->names([
        'index'=>'sales.home',
        'create'=>'sales.create',
        'store'=>'sales.save',
        'edit'=>'sales.edit',
        'update'=>'sales.update',
        'destroy'=>'sales.delete'
    ]);


    Route::put('/mrr',[MrrController::class,'search']);

    Route::resource('/mrr',MrrController::class)->names([
        'index'=>'mrr.home',
        'create'=>'mrr.create',
        'store'=>'mrr.save',
        'edit'=>'mrr.edit',
        'update'=>'mrr.update',
        'destroy'=>'mrr.delete'
    ]);


    Route::put('/invoice',[InvoiceController::class,'search']);

    Route::resource('/invoice',InvoiceController::class)->names([
        'index'=>'invoice.home',
        'create'=>'invoice.create',
        'store'=>'invoice.save',
        'edit'=>'invoice.edit',
        'update'=>'invoice.update',
        'destroy'=>'invoice.delete'
    ]);

    Route::resource('/supplier',SupplierController::class)->names([
        'index'=>'supplier.home',
        'create'=>'supplier.create',
        'store'=>'supplier.save',
        'edit'=>'supplier.edit',
        'update'=>'supplier.update',
        'destroy'=>'supplier.delete'
    ]);

    
    Route::resource('/manufacturer',ManufacturerController::class)->names([
        'index'=>'manufacturer.home',
        'create'=>'manufacturer.create',
        'store'=>'manufacturer.save',
        'edit'=>'manufacturer.edit',
        'update'=>'manufacturer.update',
        'destroy'=>'manufacturer.delete'
    ]);



    });

