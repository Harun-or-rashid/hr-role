<?php

use Illuminate\Support\Facades\Route;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
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
Route::get('/user','UserController@index');
Route::get('/user/getUser/','UserController@getUser')->name('user.getUser');
Route::get('email',function (){
    Mail::to('email@email.com')->send(new ContactMail());
   return new ContactMail();
});
Route::get('',function (){
    return view('backend.login');
});
Route::get('list','EmployeeController@index');
Route::post('store','EmployeeController@store');


Route::get('signin/','LoginController@showLogin')->name('signin');
Route::post('login','LoginController@login')->name('login');
Route::get('out','LoginController@logOut')->name('logout');
Route::group(['middleware'=>['auth']],function (){
        Route::get('contact','ContactController@index')->name('contact-us');
        Route::prefix('employees')->name('employee.')->group(function (){
            Route::get('/','EmployeeController@index')->name('index');
            Route::get('/show/{id}','EmployeeController@show')->name('show');
            Route::get('/create','EmployeeController@create')->name('create')->middleware('admin');
            Route::post('/store','EmployeeController@store')->name('store');
            Route::get('/edit/{id}','EmployeeController@edit')->name('edit');
            Route::post('/update/{id}','EmployeeController@update')->name('update');
            Route::get('/delete/{id}','EmployeeController@destroy')->name('delete');
            });
            Route::get('/role/{id}','RoleController@edit');
            Route::get('/role','RoleController@index');



});
Route::prefix('contacts')->name('contact.')->group(function (){
    Route::get('/','ContactController@index');
    Route::post('/store','ContactController@store')->name('create-contact');
});



