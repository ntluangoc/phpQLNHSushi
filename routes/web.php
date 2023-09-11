<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserInfoController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GiftCodeController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\TableController;
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

Route::get('/', [LoginController::class, 'index' ])->name('home');
Route::get('/loginPage', [LoginController::class, 'loginPage']);
Route::post('/login/signin', [LoginController::class, 'login' ]);
Route::post('/login/signup', [LoginController::class, 'signUp']);
Route::get('/logout',[LoginController::class, 'logout' ]);
Route::get('/menu', [MenuController::class, 'index']);
Route::middleware('auth')->group(function (){
    Route::get('/cancel', [LoginController::class, 'cancel'])->name('cancel');
    Route::get('/editUser/{user}', [UserInfoController::class, 'edit']);
    Route::post('/postedit/{user}', [UserInfoController::class, 'postedit']);
    Route::get('/getRemainingAmount/{idFood}', [CartController::class, 'checkRemaining']);
    Route::get('/getGiftCode/{nameGF}', [GiftCodeController::class, 'getGiftCode']);
    Route::get('/bill/{idBill}', [BillController::class, 'billPage']);
    Route::get('/information/{idUser}', [UserInfoController::class, 'infoPage']);
    Route::get('/editBookingTable/{bookingTable}', [BookingController::class, 'editBookingTablePage']);
    Route::post('/posteditBookingTable/{bookingTable}', [BookingController::class, 'posteditBookingTable']);
    Route::get('/purchase/{idBookingTable}', [BookingController::class, 'purchaseBookingTablePage']);
    Route::get('/getNumBookingFood/{idBookingTable}', [BookingController::class, 'getNumBookingFood']);
    Route::get('/addBookingFood/{idBookingTable}', [BookingController::class, 'addBookingFoodPage']);
    Route::post('/addFoodToBookingFood', [BookingController::class, 'postAddBookingFood']);
    Route::post('/updateAmountBF', [BookingController::class, 'updateAmountBF']);
    Route::get('/deleteBF/{idBookingFood}', [BookingController::class, 'deleteBookingFood']);
    Route::post('/addBillWithBookingTable', [BillController::class, 'addBillWithBookingTable']);
    Route::get('/listBill', [BillController::class, 'listBill']);
    Route::post('/listBill', [BillController::class, 'listBillByDate']);
    Route::get('/getTimeOpenClose', [RestaurantController::class, 'getTimeOpenClose']);
});
Route::middleware(['auth', 'role:ADMIN'])->group(function (){
    Route::prefix('admin')->group(function (){
        Route::get('/', [LoginController::class, 'index'])->name('admin');
        Route::get('/addFood', [MenuController::class, 'add']);
        Route::post('/addFood/save', [MenuController::class, 'postadd']);
        Route::get('/editFood/{food}', [MenuController::class, 'edit']);
        Route::post('/editFood/save/{food}', [MenuController::class, 'postedit']);
        Route::post('/deleteFood', [MenuController::class, 'delete']);
        Route::get('/listEmployee', [EmployeeController::class, 'index']);
        Route::post('/listEmployee', [EmployeeController::class, 'search']);
        Route::get('/addEmployee', [EmployeeController::class, 'addPage']);
        Route::post('/addEmployee', [EmployeeController::class, 'postadd']);
        Route::get('/editEmployee/{idEmployee}', [EmployeeController::class, 'editPage']);
        Route::post('/editEmployee/{idEmployee}', [EmployeeController::class, 'postedit']);
        Route::get('/deleteEmployee/{idUser}', [EmployeeController::class, 'delete']);
        Route::get('/deleteBookingTable/{idBookingTable}', [BookingController::class, 'deleteBookingTable']);
        Route::get('/booking',[BookingController::class, 'listBookingTable']);
        Route::post('/booking',[BookingController::class, 'searchListBookingTable']);
        Route::post('/confirm', [BookingController::class, 'confirm']);
        Route::post('/updateBillWithBookingTable', [BillController::class, 'updateBillWithBookingTable']);
        Route::get('/listCustomer', [CustomerController::class, 'index']);
        Route::get('/searchCusByName', [CustomerController::class, 'searchByName']);
        Route::get('/restaurant', [RestaurantController::class, 'getRestaurant']);
        Route::post('/restaurant', [RestaurantController::class, 'updateTimeRestaurant']);
        Route::get('/getRevenueByMonth', [RestaurantController::class, 'getRevenueByMonth']);
        Route::get('/getRevenueByDay', [RestaurantController::class, 'getRevenueByDay']);
        Route::get('/listTable', [TableController::class, 'index']);
        Route::get('/addTable', [TableController::class, 'addTablePage']);
        Route::post('/addTable', [TableController::class, 'postaddTable']);
        Route::get('/editTable/{table}', [TableController::class, 'editTablePage']);
        Route::post('/editTable/{table}', [TableController::class, 'posteditTable']);
        Route::get('/deleteTable/{idTable}', [TableController::class, 'deleteTable']);
        Route::get('/giftcode', [GiftCodeController::class, 'getListGiftCode']);
        Route::post('/addeditGiftCode', [GiftCodeController::class, 'addGiftCode']);
        Route::get('/deleteGiftCode/{idGiftCode}', [GiftCodeController::class, 'deleteGiftCode']);
    });
});
Route::middleware(['auth', 'role:EMPLOYEE'])->group(function (){
    Route::prefix('employee')->group(function (){
        Route::get('/', [LoginController::class, 'index'])->name('employee');
        Route::get('/searchCusByPhone', [CustomerController::class, 'searchByPhone']);
        Route::get('/booking',[BookingController::class, 'listBookingTable']);
        Route::post('/booking',[BookingController::class, 'searchListBookingTable']);
        Route::post('/confirm', [BookingController::class, 'confirm']);
        Route::get('/listCustomer', [CustomerController::class, 'indexWithEmployee']);
        Route::get('/searchCusByPhone', [CustomerController::class, 'searchByPhone']);
        Route::get('/listTable', [TableController::class, 'index']);
    });
});
Route::middleware(['auth', 'role:CUSTOMER'])->group(function (){
    Route::prefix('customer')->group(function (){
        Route::get('/', [LoginController::class, 'index'])->name('customer');
        Route::get('/getNumCart', [CartController::class, 'getNumCart']);
        Route::get('/getTop5Cart', [CartController::class, 'getTop5Cart']);
        Route::post('/addFoodToCart', [CartController::class, 'addFoodToCart']);
        Route::get('/cart', [CartController::class, 'cartPage']);
        Route::post('/updateAmountCF', [CartController::class, 'updateAmountCF']);
        Route::get('/booking', [BookingController::class, 'addBookingTablePage']);
        Route::post('/addBookingTable', [BookingController::class, 'postAddBookingTable']);
        Route::post('/addBillWithCart', [BillController::class, 'addBillWithCart']);
        Route::get('/buynow/{idFood}', [CartController::class, 'buyNowPage']);
        Route::post('/addBillWithFoodBuyNow', [BillController::class, 'addBillWithFoodBuyNow']);
        Route::get('/deleteCF/{idCartFood}', [CartController::class, 'deleteCartFood']);
    });
});
