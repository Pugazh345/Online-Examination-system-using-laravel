<?php

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
    return view('welcome');
})->name('welcome');

Route::group(['middleware' => 'prevent-back-history'],function(){
    Auth::routes();
    // Route::get('/home', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

  });
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user/logout','Auth\LoginController@userlogout')->name('user.logout');
Route::get('/startexam/{id}','HomeController@startexam')->name('user.startexam');
Route::post('/user/submitexam','HomeController@submitexam')->name('user.submitexam');
Route::get('/result','HomeController@result')->name('user.result');

Route::prefix('admin')->group(function(){
    Route::get('/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::post('/logout','Auth\AdminLoginController@adminlogout')->name('admin.logout');
    Route::get('/viewaddbatch','AdminController@vcrbatch')->name('admin.vcrbatch');
    Route::post('/addbatch','AdminController@addbatch')->name('admin.crbatch');
    Route::delete('/batchdelete/{id}','AdminController@deletebatch')->name('admin.deletebatch');

    Route::get('/registerstudent','AdminController@regstudent')->name('admin.regstudent');
    Route::delete('/studentdelete/{id}','AdminController@deletestudent')->name('admin.deletestudent');
    
    Route::get('/viewcreateexam','AdminController@viewcreateexam')->name('admin.vcrexam');     
    Route::post('/createexam','AdminController@createexam')->name('admin.crexam'); 
    Route::delete('/examdelete/{id}','AdminController@deleteexam')->name('admin.deleteexam');

    Route::get('/questionsection','AdminController@addqnexamdisp')->name('admin.addqnexamdisp');     
    Route::post('/addobjqn','AdminController@addobjqn')->name('admin.addobjqn');
    Route::delete('/objqndelete/{id}','AdminController@deleteobjqn')->name('admin.deleteobjqn');

    Route::post('/addobjimgqn','AdminController@addobjimgqn')->name('admin.addobjimgqn');
    Route::delete('/objiqndelete/{id}','AdminController@deleteobjiqn')->name('admin.deleteobjiqn');

    Route::post('/addfillupqn','AdminController@addfillupqn')->name('admin.addfillupqn');     
    Route::delete('/fillqndelete/{id}','AdminController@deletefillqn')->name('admin.deletefillqn');

    Route::post('/addfillupimgqn','AdminController@addfillupimgqn')->name('admin.addfillupimgqn');     
    Route::delete('/filliqndelete/{id}','AdminController@deletefilliqn')->name('admin.deletefilliqn');

    Route::post('/addmtfqn','AdminController@addmtfqn')->name('admin.addmtfqn');     
    Route::delete('/mtfqndelete/{id}','AdminController@deletemtfqn')->name('admin.deletemtfqn');
    
    Route::post('/addmtfimgqn','AdminController@addmtfimgqn')->name('admin.addmtfimgqn');     
    Route::delete('/mtfiqndelete/{id}','AdminController@deletemtfiqn')->name('admin.deletemtfiqn');

    Route::get('/conductexamview','AdminController@conductexamview')->name('admin.conductexamview');     
    Route::post('/conductexam','AdminController@conductexam')->name('admin.conductexam');     
    Route::delete('/conductedexamdelete/{id}','AdminController@deleteconductedexam')->name('admin.deleteconductedexam');
    
    
    Route::post('/studentedit/{id}','AdminController@editstudent')->name('admin.editstudent');
    Route::get('/studentList','AdminController@export')->name('admin.export');

    // Route::post('/studentactive/{id}','AdminController@changestudentstate')->name('admin.changestudentstate');
    

    


    
});
