<?php

use App\Http\Controllers\CompareController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\PanelUserController;
use App\Http\Controllers\PanelBrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KsmainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\VehicleController;



//HOMEPAGE
Route::get('/' ,[KsmainController::class,"homepage"])->name('home')->middleware('CheckBanned')->middleware('UserActiveLog');;
Route::get('/aboutus',[KsmainController::class,"aboutus"]);



//USER
Route::get('/register', [RegisterController::class, "RegisterPage"]);
Route::post('/registration',[RegisterController::class,"Registration"]);
Route::get('/login', [LoginController::class, "Login"])->name('login');
Route::post('/login',[LoginController::class,"LoginCheck"]);
Route::post('/logout',[UserController::class,"Logout"]);
Route::get('/logout',[UserController::class,"Logout"])->name('logout');
Route::get('/update',[UserController::class,"UpdatePage"]);
Route::post('/update',[UserController::class,"ProfileUpdate"]);
Route::get('/update/password',[UserController::class,"PasswordPage"]);
Route::post('/update/password',[UserController::class,"UpdatePassword"]);
Route::get('/update/email',[UserController::class,"EmailPage"]);
Route::post('/update/email',[UserController::class,"EmailUpdate"]);
Route::get('/profile',[UserController::class,"Profile"]);
Route::get('update-avatar',[UserController::class,"AvatarPage"]);
Route::post('update-avatar',[UserController::class,"UpdateAvatar"]);
Route::Get('/favorites/{id}',[UserController::class,"NewFavorite"]);
Route::get('/favorites',[UserController::class,"Favorites"]);
Route::get('/favorites/delete/{id}',[UserController::class,"DeleteFavorite"]);

//ADMIN PAGES -------------------------------------------------

Route::middleware(['auth', 'AuthTypeCheck:editor,admin'])->group(function () {

    Route::get('/dashboard', [PanelController::class, 'Dashboard']);
    Route::post('/todolist/add',[PanelController::class,'AddToDoList']);
    Route::get('/todolist/delete/{id}',[PanelController::class,'DeleteToDoList']);
    Route::post('/notlist/add',[PanelController::class,'AddNotList']);
    Route::get('/notlist/delete/{id}',[PanelController::class,'DeleteNotList']);

    Route::Get('/getallbrand',[PanelBrandController::class,'getallbrands']);
    Route::get('/brand/add',[PanelBrandController::class,'BrandAddPage']);
    Route::post('/brand/add',[PanelBrandController::class,'BrandAdd']);
    Route::get('/brand/delete/{id}',[PanelBrandController::class,'BrandDelete'])->middleware('AuthTypeCheck:admin');
    Route::get('/brand/edit/{id}',[PanelBrandController::class,'BrandEdit']);
    Route::post('/brand/editsave/{id}',[PanelBrandController::class,'BrandEditSave']);

    Route::get('/getallmodels',[PanelController::class,'GetAllModels']);
    Route::get('/model/add',[PanelController::class,'ModelAddPage']);
    Route::post('/model/add',[PanelController::class,'ModelAdd']);
    Route::get('model/{id}/edit',[PanelController::class,'ModelEdit']);
    Route::post('/model/editsave/{id}',[PanelController::class,'ModelEditSave']);
    Route::post('/carsdelete/{id}',[PanelController::class,'DeleteModel'])->name('DeleteModel')->middleware('AuthTypeCheck:admin');


    Route::get('/getnews',[PanelController::class,'getallnews']);
    Route::Get('/news/add',[PanelController::class,'NewsAddPage']);
    Route::post('/news/add',[PanelController::class,'NewsAdd']);
    Route::get('/haber/{news}/edit',[NewsController::class,'NewsEdit'])->middleware('can:update,news');
    Route::post('/edit/{id}',[NewsController::class,'NewsEditSave'])->name('EditNew');
    Route::post('/newsdelete/{id}',[NewsController::class,'DeleteNew'])->name('DeleteNew');



    Route::get('/ban/{id}',[PanelUserController::class,'UserBan'])->name('UserBan')->middleware('AuthTypeCheck:admin');
    Route::get('/UserEdit/{id}',[PanelUserController::class,'UserEdit'])->name('UserEdit')->middleware('AuthTypeCheck:admin');
    Route::post('/UserEdit/{id}',[PanelUserController::class,'UserEditSave'])->name('UserEditSave')->middleware('AuthTypeCheck:admin');
    Route::get('/AvatarDelete/{id}',[PanelUserController::class,'AvatarDelete'])->name('AvatarDelete')->middleware('AuthTypeCheck:admin');
    Route::get('/getallusers',[PanelUserController::class,'GetAllUsers']);
    Route::get('/delete/{id}',[PanelUserController::class,'UserDelete'])->name('UserDelete')->middleware('AuthTypeCheck:admin');



});

//NEWS --------------------------------------------------------------

Route::Get('/haberler',[NewsController::class,"NewsPage"]);
route::get('/haber/{newid}',[NewsController::class,"NewsDetail"]);
Route::get('/haberler/{marka}',[NewsController::class,"NewsBrand"]);
Route::post('haber/yorum/{id}',[NewsController::class,"NewCommentSave"])->name('NewCommentSave');
Route::get('/deletecomment/{NewsComments:comment_id}',[NewsController::class,'DeleteComment'])->name('DeleteComment');
Route::get('/search/{term}',[NewsController::class,"search"]);


//COMPARE
Route::post('/compareList/module/store',[CompareController::class,"storecomparelist"])->name('storecompareList');
Route::Get('/compareList/remove/{id}',[CompareController::class,"removecomparelist"])->name('removecompareList');
Route::Get('/karsilastir/listem',[CompareController::class,"showcompareList"])->name('showcompareList')->middleware('auth');
Route::Get('/karsilastir',[CompareController::class,"compareselect"])->name('compareselect');
Route::Get('/karsilastir/{ids}',[CompareController::class,"selectresult"])->name('selectresult');

//CAR PAGES
Route::Get('/yakit-hesapla',[KsmainController::class,"Fuelcalc"]);
Route::get('markalar',[KsmainController::class,"AllBrands"]);
Route::get('/rastgele',[KsmainController::class,"RandomCar"]);
Route::Get('/elektrikliler',[KsmainController::class,'ElectricCar']);
Route::get('/en-hizli-arabalar',[KsmainController::class,"FastestCar"]);
Route::get('/en-yavas-arabalar',[KsmainController::class,"SlowestCar"]);
Route::get('/en-cokyakan-arabalar',[KsmainController::class,"FuelCar"]);
Route::get('/en-azyakan-arabalar',[KsmainController::class,"FuelLowCar"]);
Route::post('car-rate/{id}',[VehicleController::class,'CarRate'])->middleware('auth');
Route::get('/dcomment/{CarComments:comment_id}',[VehicleController::class,'DComment'])->name('DComment')->middleware('auth');

Route::get('/{brand}',[VehicleController::class,'VehicleRoute'])->name('VehicleRoute');
Route::get('/{brand}/{model_name}',[VehicleController::class,'ModelRoute'])->name('ModelRoute');
Route::get('/{brand}/{model_name}/filtre/asc',[VehicleController::class,'ModelRouteFilter']);
Route::get('/{brand}/{model_name}/{id}',[VehicleController::class,'SpecRoute'])->name('SpecRoute');
Route::post('model/yorum/{id}',[VehicleController::class,"ModelCommentSave"])->name('ModelCommentSave')->middleware('auth');




