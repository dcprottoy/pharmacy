<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CellController;
use App\Http\Controllers\Backend\StoreLocationController;
use App\Http\Controllers\Backend\ProductTypeController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\ProductSubCategoriesController;
use App\Http\Controllers\Backend\MedicineUsageController;
use App\Http\Controllers\Backend\MedicineTypeController;
use App\Http\Controllers\Backend\MedicineCategoryController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ManufacturerController;
use App\Http\Controllers\Backend\MedecineController;
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


    Route::resource('/cell',CellController::class)->names([
        'index'=>'cell.home',
        'create'=>'cell.create',
        'store'=>'cell.save',
        'edit'=>'cell.edit',
        'update'=>'cell.update',
        'destroy'=>'cell.delete'
    ]);

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

    Route::resource('/productcategory',ProductCategoryController::class)->names([
        'index'=>'productcategory.home',
        'create'=>'productcategory.create',
        'store'=>'productcategory.save',
        'edit'=>'productcategory.edit',
        'update'=>'productcategory.update',
        'destroy'=>'productcategory.delete'
    ]);

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


    Route::resource('/medicinetype',MedicineTypeController::class)->names([
        'index'=>'medicinetype.home',
        'create'=>'medicinetype.create',
        'store'=>'medicinetype.save',
        'edit'=>'medicinetype.edit',
        'update'=>'medicinetype.update',
        'destroy'=>'medicinetype.delete'
    ]);


    Route::resource('/medicinecategory',MedicineCategoryController::class)->names([
        'index'=>'medicinecategory.home',
        'create'=>'medicinecategory.create',
        'store'=>'medicinecategory.save',
        'edit'=>'medicinecategory.edit',
        'update'=>'medicinecategory.update',
        'destroy'=>'medicinecategory.delete'
    ]);



    Route::resource('/category',CategoryController::class)->names([
        'index'=>'category.home',
        'create'=>'category.create',
        'store'=>'category.save',
        'edit'=>'category.edit',
        'update'=>'category.update',
        'destroy'=>'category.delete'
    ]);

    Route::resource('/medecine',MedecineController::class)->names([
        'index'=>'medecine.home',
        'create'=>'medecine.create',
        'store'=>'medecine.save',
        'edit'=>'medecine.edit',
        'update'=>'medecine.update',
        'destroy'=>'medecine.delete'
    ]);


    Route::get('/todaysummary',[MedecineStockController::class,'todaySummary'])->name('todaystock.home');
    Route::get('/stockentrysummary',[MedecineStockController::class,'stockEntrySummary'])->name('stockentry.home');
    Route::post('/stockentrysummary',[MedecineStockController::class,'stockEntrySummaryDate'])->name('stockentry.details');


    Route::put('/medecinestock',[MedecineStockController::class,'search']);

    Route::resource('/medecinestock',MedecineStockController::class)->names([
        'index'=>'medecinestock.home',
        'create'=>'medecinestock.create',
        'store'=>'medecinestock.save',
        'edit'=>'medecinestock.edit',
        'update'=>'medecinestock.update',
        'destroy'=>'medecinestock.delete'
    ]);


    Route::put('/stockmedecine',[StockMedecineController::class,'search']);

    Route::resource('/stockmedecine',StockMedecineController::class)->names([
        'index'=>'stockmedecine.home',
        'create'=>'stockmedecine.create',
        'store'=>'stockmedecine.save',
        'edit'=>'stockmedecine.edit',
        'update'=>'stockmedecine.update',
        'destroy'=>'stockmedecine.delete'
    ]);

    Route::resource('/sales',SalesController::class)->names([
        'index'=>'sales.home',
        'create'=>'sales.create',
        'store'=>'sales.save',
        'edit'=>'sales.edit',
        'update'=>'sales.update',
        'destroy'=>'sales.delete'
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

