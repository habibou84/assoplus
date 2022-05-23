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


Route::post('/existing', 'VerifsController@existing');
Route::post('/checkcode', 'VerifsController@checkcode');
Route::post('/checkincomingcode', 'VerifsController@checkincomingcode');
Route::post('/incoming_membre', 'VerifsController@incomingmembre');

Route::get('/newincomingchild', 'VerifsController@newincomingchild');
Route::post('/checkstatus', 'VerifsController@newincomingchild');
Route::post('/addincomingchild', 'VerifsController@addincomingchild');
Route::post('/editincomingchild', 'VerifsController@editincomingchild');
Route::post('/deleteincomingchild','VerifsController@deleteincomingchild');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth', 'livreur']], function(){
 
 Route::get('/requetes','RequetesController@requetes');
 Route::get('/requete','RequetesController@requete');
 Route::post('/requete_edit', 'RequetesController@edit');
 Route::post('/sendmessage','RequetesController@sendmessage');


Route::post('/nominate','MembersController@nominate');



Route::post('/add_member','MembersController@add');
Route::post('/edit_member','MembersController@edit');
Route::get('/bureau','MembersController@bureau');
Route::get('/postes','MembersController@postes');
Route::get('/demandes','IncomingsController@membres');
Route::get('/demande','IncomingsController@membre');
Route::get('/codes','IncomingsController@codes');
Route::post('/addcode','IncomingsController@addcode');
Route::post('/deletecode','IncomingsController@deletecode');
Route::post('/deleteincoming','IncomingsController@deleteincoming');
Route::post('/refuseincoming','IncomingsController@refuse');
Route::post('/acceptincoming','IncomingsController@add');


Route::post('/poste_edit','PostesController@edit');
Route::post('/poste_delete','PostesController@delete');
Route::post('/add_post','PostesController@add');
Route::post('/getavailableposts','PostesController@getavailableposts');
Route::post('/removeposte','PostesController@removeposte');



Route::get('/membre', 'MembersController@membre');

Route::get('/cotisations','CotisationsController@cotisations');
Route::post('/magicbirthday','CotisationsController@magicbirthday');
Route::post('/addperiodic','CotisationsController@addperiodic');
Route::post('/addponctual','CotisationsController@addponctual');

Route::post('/editperiodic','CotisationsController@editperiodic');
Route::post('/editponctual','CotisationsController@editponctual');
Route::post('/cotisation_delete','CotisationsController@delete');



Route::get('/depanses','DepansesController@depanses');
Route::post('/add_depanse','DepansesController@add');
Route::post('/add_source','DepansesController@addsource');
Route::post('/depanse_delete','DepansesController@delete');
Route::post('/deletedetail','DepansesController@deletedetail');
Route::post('/edit_depanse','DepansesController@edit');
Route::post('/adddetails','DepansesController@addetails');

Route::post('/deletebenef','DepansesController@deletebenef');
Route::post('/getlist','DepansesController@getlist');

Route::post('/addbenefs','DepansesController@addbenefs');

Route::get('/payements','PayementsController@payements');
Route::post('/pay','PayementsController@pay');
Route::post('/exhonerate','PayementsController@exhonerate');
Route::post('/edit_pay','PayementsController@editpay');
Route::post('/payement_delete','PayementsController@delete');
Route::get('/monthlypay','PayementsController@monthlypay');
Route::get('/ponctualpay','PayementsController@ponctualpay');
Route::get('/mesmonthlypay','PayementsController@mesmonthlypay');
Route::get('/mesponctualpay','PayementsController@mesponctualpay');
Route::get('/mespayements','PayementsController@mespayements');

Route::post('/membre_delete','MembersController@delete');
Route::post('/deletechild','MembersController@deletechild');



Route::post('/reversepaysous','SouscriptionsController@reversepaysous');
Route::post('/terminate','SouscriptionsController@terminate');
Route::post('/encours','SouscriptionsController@encours');
Route::get('/commissions','SouscriptionsController@commissions');

Route::post('/verse','SouscriptionsController@verse');
Route::post('/sous_delete','SouscriptionsController@delete');
Route::post('/edit_sous','SouscriptionsController@edit');

Route::get('/commencer', 'Admin\DashboardController@commencer');
Route::post('/editass', 'Admin\DashboardController@editass');
Route::post('/editpassword', 'Admin\DashboardController@editpassword');
Route::get('/association', 'Admin\DashboardController@association');
Route::get('/membres', 'MembersController@membres');
Route::post('/addchild', 'MembersController@addchild');
Route::post('/editchild', 'MembersController@editchild');


Route::get('/infos', 'InfosController@infos');
Route::get('/info', 'InfosController@info');
Route::post('/info_delete', 'InfosController@delete');
Route::post('/info_edit', 'InfosController@edit');
Route::post('/editinfostatus', 'InfosController@editinfostatus');


Route::get('/infosactive', 'InfosController@infosactive');
Route::get('/infospending', 'InfosController@infospending');
Route::get('/infosrefused', 'InfosController@infosrefused');
Route::get('/infosterminated', 'InfosController@infosterminated');
Route::post('/addinfo', 'InfosController@addinfo');

Route::get('/rapport','RaportController@raport');
Route::get('/mesinfos','InfosController@mesinfos');


 }); 






