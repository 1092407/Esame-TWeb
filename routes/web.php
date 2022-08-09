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

/*Route::get('/', function () {
    return view('welcome');
});
*/


// ROTTE PUBBLICHE

Route::view('/Chi','chisiamo')->name('chi');  // per la vista chi siamo
Route::view('/Dove','dovesiamo')->name('dove');  // per la vista dove siamo
Route::view('/Cosa','cosa')->name('cosa');  // per la vista informazioni sul servizio offerto
Route::view('/Privacy','privacy_cookies')->name('privacy'); // per la vista sulle info relative alla privacy
Route::view('/Regolamento','termini_condizioni')->name('termini_condizioni'); // per la vista relativa ai termini di condizioni

Route::get('/', 'PublicController@showHomepage')->name('home'); // per aprire home page pubblica


//ROTTE ADMIN
//Route::get('/Admin','AdminController@index')->name('admin')->middleware('can:isAdmin');
//Route::post('/Admin','AdminController@showStatistiche')->name('adminfilter');

Route::view('/Admin','homeadmin')->name('admin')->middleware('can:isAdmin');   // porta alla homepage riservata all'admin
Route::view('/statistiche','statistiche')->name('statistiche');  // porta alla view che visualizza le statistiche
Route::view('/Gestionestaff','gestionestaff')->name('gestiscistaff');// porta alla vista che mi fa gestire i membri dello staff





//ROTTE STAFF

Route::view('/Staff','homestaff')->name('staff');   // porta alla homepage riservata ai membri dello staff
Route::view('/Messaggi','messaggi')->name('messaggi');  // porta alla view che visualizza la pagina dove vedo i messaggi
  Route::view('/Gestioneblog','gestioneblog')->name('gestisciblog');// porta alla vista che mi fa controllare i contenuti dei blog e post degli utenti



//ROTTE UTENTE

Route::view('/Utente','homeutente')->name('utente')->middleware('can:isUtente')->middleware('auth');   // porta alla homepage riservata agli utenti del sito
Route::view('/messaggi','messaggi')->name('messaggi');  // porta alla view che visualizza la pagina dove vedo i messaggi
 Route::view('/Blog','mioblog')->name('miooblog');// porta alla vista che mi fa vedere i miei blog
Route::view('/Amici','mioamico')->name('amici');   // porta alla homepage riservata agli utenti del sito
Route::view('/Cercapersone','cercapersone')->name('cerca');  // porta alla view che visualizza la pagina dove cerco potenziali amici
Route::view('/Profilo','profiloutente')->name('profilo');  // porta alla vista che mi fa vedere tutti i dati relativi al mio profilo


Route::view('/Blog','mioblog')->name('miooblog');


//Sottoinsime di Auth::routes()
Route::get('login','Auth\LoginController@showLoginForm')->name('login')->middleware('guest'); //Rotta che genera la form GET
Route::post('login','Auth\LoginController@login');//Usata al submit della form che attiva il processo di autenticazione
Route::get('logout','Auth\LoginController@logout')->name('logout');
Route::get('register','Auth\RegisterController@showRegistrationForm')->name('register')->middleware('guest');//Rotta che genera la form di registrazione
Route::post('register','Auth\RegisterController@register'); //Rotta che effettivamente registra l'utente

//Auth::routes();   // rotte con ui e auth

 // Route::get('/home', 'HomeController@index')->name('home'); // rotta ottenuta con auth di ui
