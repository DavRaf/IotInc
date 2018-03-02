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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/home','AdminController@index')->name('admin.home');

Route::get('admin','Admin\LoginController@showLoginForm')->name('admin.login');

Route::post('admin','Admin\LoginController@login');

Route::post('admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');

Route::get('admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');

Route::post('admin-password/reset','Admin\ResetPasswordController@reset');

Route::get('admin-password/reset{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

//Route::get('verifyEmailFirst','Auth\RegisterController@verifyEmailFirst')->name('verifyEmailFirst');

Route::get('verify/{email}/{verifyToken}','Auth\RegisterController@sendEmailDone')->name('sendEmailDone');

Route::post('admin/home/registerCliente','Admin\AddUtenteController@registerCliente')->name('registerCliente');

Route::get('admin/home/addUtente','Admin\AddUtenteController@index')->name('addUtente');

//Route::get('admin/home/accept/{id}','Admin\AddUtenteController@accept')->name('accept');

Route::get('admin/home/visualizzaClienti','Admin\VisualizzaClientiController@index')->name('visualizzaClienti');

Route::get('admin/home/{email}/sendMsg','Admin\SendMsgController@index')->name('sendMsg');

Route::post('admin/home/sendMsgExecute/{email}','Admin\SendMsgController@exec')->name('sendMsgExecute');

Route::get('admin/home/delete/{id}','Admin\VisualizzaClientiController@destroy')->name('delete');

//Route::get('admin/home/showAddSensore','Admin\AddSensoreController@index')->name('showAddSensore');

//Route::post('admin/home/addSensore','Admin\AddSensoreController@insert')->name('addSensore');

//Route::get('admin/home/addFieldSensore','Admin\AddFieldSensoreController@index')->name('addFieldSensore');

//Route::post('admin/home/addField','Admin\AddFieldSensoreController@add')->name('addField');

Route::get('admin/home/installationCRUD','Installation\InstallationCRUDController@index')->name('installationCRUD.index');
Route::get('admin/home/installationCRUD/create','Installation\InstallationCRUDController@create')->name('installationCRUD.create');
Route::post('admin/home/installationCRUD','Installation\InstallationCRUDController@store')->name('installationCRUD.store');
Route::get('admin/home/installationCRUD/show/{id}','Installation\InstallationCRUDController@show')->name('installationCRUD.show');
Route::get('admin/home/installationCRUD/{id}/edit','Installation\InstallationCRUDController@edit')->name('installationCRUD.edit');
Route::put('admin/home/installationCRUD/{id}','Installation\InstallationCRUDController@update')->name('installationCRUD.update');
Route::delete('admin/home/installationCRUD/{id}','Installation\InstallationCRUDController@destroy')->name('installationCRUD.destroy');
Route::get('admin/home/installationCRUD/{id}/addSensore','Installation\InstallationCRUDController@addSensore')->name('installationCRUD.addSensore');
Route::post('admin/home/installationCRUD/{id}/storeSensore','Installation\InstallationCRUDController@storeSensore')->name('installationCRUD.storeSensore');
Route::get('admin/home/installationCRUD/{id}/editSensore','Installation\InstallationCRUDController@editSensore')->name('installationCRUD.editSensore');
Route::get('admin/home/installationCRUD/{id}/listSensori','Installation\InstallationCRUDController@listSensori')->name('installationCRUD.listSensori');

Route::get('admin/home/sensoreCRUD','Sensore\SensoreCRUDController@index')->name('sensoreCRUD.index');
Route::get('admin/home/sensoreCRUD/create','Sensore\SensoreCRUDController@create')->name('sensoreCRUD.create');
Route::post('admin/home/sensoreCRUD','Sensore\SensoreCRUDController@store')->name('sensoreCRUD.store');
Route::get('admin/home/sensoreCRUD/{id}/edit','Sensore\SensoreCRUDController@edit')->name('sensoreCRUD.edit');
Route::put('admin/home/sensoreCRUD/{id}','Sensore\SensoreCRUDController@update')->name('sensoreCRUD.update');
Route::delete('admin/home/sensoreCRUD/{id}','Sensore\SensoreCRUDController@destroy')->name('sensoreCRUD.destroy');

Route::get('admin/home/sensoreCRUD/{id}/cambiaStato/{stato}','Sensore\SensoreCRUDController@cambiaStato')->name('sensoreCRUD.cambiaStato');

Route::get('admin/home/visualizzaMalfunzionamenti','Sensore\VisualizzaMalfunzionamentiController@show')->name('visualizzaMalfunzionamenti');
Route::get('admin/home/visualizzaMalfunzionamenti/{id}/mostraDettagli','Sensore\VisualizzaMalfunzionamentiController@showDetails')->name('mostraDettagli');

Route::get('client/home/modificaProfilo','Auth\ModificaProfiloController@index')->name('modificaProfilo.index');
Route::post('client/home/modificaProfilo/{id}','Auth\ModificaProfiloController@edit')->name('modificaProfilo.edit');
Route::get('client/home/visualizzaImpianti/list','Auth\VisualizzaImpiantiController@list')->name('visualizzaImpianti.list');
Route::get('client/home/visualizzaImpianti/{id}/show','Auth\VisualizzaImpiantiController@show')->name('visualizzaImpianti.show');
Route::get('client/home/simulaRicezioneRilevazione','Rilevazione\SimulaRicezioneRilevazioneController@index')->name('simulaRicezioneRilevazione.index');
Route::get('client/home/simulaRicezioneRilevazione/execute','Rilevazione\SimulaRicezioneRilevazioneController@execute')->name('simulaRicezioneRilevazione.execute');
Route::get('client/home/visualizzaRilevazioni/selectImpianto','Rilevazione\VisualizzaRilevazioniController@selectImpianto')->name('visualizzaRilevazioni.selectImpianto');
Route::get('client/home/visualizzaRilevazioni/selectSensore','Rilevazione\VisualizzaRilevazioniController@selectSensore')->name('visualizzaRilevazioni.selectSensore');
Route::get('client/home/visualizzaRilevazioni/list','Rilevazione\VisualizzaRilevazioniController@list')->name('visualizzaRilevazioni.list');
Route::get('client/home/visualizzaRilevazioni/{id}/show','Rilevazione\VisualizzaRilevazioniController@show')->name('visualizzaRilevazioni.show');
Route::get('client/home/condividiRilevazione/{id}','Rilevazione\CondividiRilevazioneController@index')->name('condividiRilevazione.index');
Route::post('client/home/condividiRilevazione/{id}/sendEmail','Rilevazione\CondividiRilevazioneController@sendEmail')->name('condividiRilevazione.sendEmail');
Route::get('client/home/selectImpianto','Rilevazione\StoricoRilevazioniController@index')->name('storico.index');
Route::get('client/home/storicoImpianto','Rilevazione\StoricoRilevazioniController@graphs')->name('storico.graphs');
Route::get('client/home/storicoSensore','Rilevazione\StoricoRilevazioniController@graphSensore')->name('storico.graphSensore');
Route::get('client/home/download/{numero}','Rilevazione\DownloadController@esporta')->name('esporta');
Route::get('client/home/downloadAll','Rilevazione\DownloadController@esportaTutto')->name('esportaTutto');




