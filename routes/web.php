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


Route::view('/Admin','homeadmin')->name('admin')->middleware('can:isAdmin');   // porta alla homepage riservata all'admin

Route::get('/statistiche','AdminController@index')->name('statistiche');   // mi porta all view statistiche generale

 // per registrare un nuovo membro dello staff
Route::get('/Admin/Registrastaff','AdminController@mettistaff')->name('registrastaff'); // mi genera la vista per inserire nuovi membri dello staff
Route::post('/Admin/Registrastaff','AdminController@storestaff')->name('registrastaff_post');  // va messa nella form nella view corrispondente

// per modificare o eliminare un membro dello staff
Route::get('/Gestionestaff','AdminController@showstaff')->name('gestiscistaff'); // porta alla vista che mi fa gestire i membri dello staff
Route::delete('/Admin/Gestionestaff/{staff}','AdminController@deletestaff')->name('staff.delete');  // per eliminare
Route::put('/Admin/Gestionestaff/{staff}','AdminController@updatestaff')->name('staff.update');// aggiorna dati
Route::get('/Admin/Gestionestaff/{staff}','AdminController@showStaffToUpdate')->name('staff.toupdate'); // va vedere i dati presenti e che posso modificare

// per vedere  le varie  statistcihe

Route::get('/Admin/statistiche/blogs/{user}','AdminController@showBlogsOfuser')->name('show_blogs_of_user');// per vedere blogs di un certo utente
Route::get('/Admin/statistiche/amici/{user}','AdminController@showAmiciOfuser')->name('show_amici_of_user');// per vedere amici di un certo utente
Route::get('/Admin/statistiche/richieste/{user}','AdminController@showRichiesteOfuser')->name('show_richieste_of_user'); // per vedere le richieste di un certo utente






//ROTTE STAFF

Route::view('/Staff','homestaff')->name('staff');   // porta alla homepage riservata ai membri dello staff
Route::view('/Messaggi','messaggi')->name('messaggi');  // porta alla view che visualizza la pagina dove vedo i messaggi
  Route::view('/Gestioneblog','gestioneblog')->name('gestisciblog');// porta alla vista che mi fa controllare i contenuti dei blog e post degli utenti



//ROTTE UTENTE

Route::get('/Utente', 'UtenteController@indexutente')->name('utente')->middleware('can:isUtente')->middleware('auth');  // porta alla homepage riservata agli utenti del sito


Route::view('/messaggi','messaggi')->name('messaggi');  // porta alla view che visualizza la pagina dove vedo i messaggi

Route::view('/Cercapersone','cercapersone')->name('cerca');  // porta alla view che visualizza la pagina dove cerco potenziali amici

//per vedere il mio profilo FUNZIONA
Route::get('/Profilo','UtenteController@ShowProfilo')->name('profilo');  // porta alla vista che mi fa vedere tutti i dati relativi al mio profilo
Route::put('/Utente/UpdateProfilo','UtenteController@updateProfilo')->name('aggiornaProfilo');

//per vedere ed eliminare  i miei blogs FUNZIONA
Route::get('/Utente/Blogs', 'UtenteController@showmyblogs')->name('mioblog');  // mi fa vedere tutti i miei blog
Route::delete('/Utente/Blog/{blog}','UtenteController@deletemyblog')->name('blog.delete');  // per eliminare un certo blog

//per creare i miei blog FUNZIONA
Route::get('/Utente/Blog','UtenteController@creablog')->name('creablog'); // mi genera la vista per creare nuovo blog
Route::post('/Utente/Blog','UtenteController@storeblog')->name('creablog_post');  // va messa nella form nella view corrispondente per creare nuovi blogs

//gestione degli amici

Route::get('/Utente/Amici', 'UtenteController@showmyfriends')->name('amici'); // per vedere tutti i miei amici
Route::delete('/Utente/Amici/{amico}','UtenteController@deletemyfriend')->name('friend.delete'); // per entrambi o solo per left? da verificare





//Sottoinsime di Auth::routes()   FINITO E NON MODIFICARE
Route::get('login','Auth\LoginController@showLoginForm')->name('login'); //Rotta che genera la form GET
Route::post('login','Auth\LoginController@login');//Usata al submit della form che attiva il processo di autenticazione
Route::post('logout','Auth\LoginController@logout')->name('logout');
Route::get('register','Auth\RegisterController@showRegistrationForm')->name('register');//Rotta che genera la form di registrazione
Route::post('register','Auth\RegisterController@register'); //Rotta che effettivamente registra l'utente

//Auth::routes();   // rotte con ui e auth

 // Route::get('/home', 'HomeController@index')->name('home'); // pagina base nuovo progetto
