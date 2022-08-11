<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
     protected $redirectTo = '/'; //proprietà predefinita che specifica la rotta a cui viene reindirizzato l'utente a fine registrazione

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      // $this->middleware('guest'); //metodo che ci consente di attivare i gate
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'foto_profilo' => ['sometimes','file', 'mimes:jpeg,png', 'max:5000'],
            'name' => ['required', 'string', 'max:255'],
            'cognome' => ['required', 'string', 'max:255'],
            'sesso' => ['required', 'string'],
            'data_nascita' => ['required', 'date','before:18 years ago'],
            'email' => ['required', 'string', 'unique:users', 'regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/'],
            'username' => ['required', 'string', 'min:8', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            // livello non vada messo qui  perchè non è un campo che compare nella form di registrazione
            //infatti voglio mettere che livello=utente di default per chi si registra tramite la view registrazione
            'descrizione' => ['required ','string','max:2500']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
         if (request()->hasFile('foto_profilo')) {
            $image = request()->file('foto_profilo');
            $imageName = $image->getClientOriginalName();
            $destinationPath = public_path().'/img/foto_profilo';
            $image->move($destinationPath, $imageName);
        } else {
            $imageName = NULL;
        }
        return User::create([
            'foto_profilo' => $imageName,
            'name' => $data['name'],
            'cognome' => $data['cognome'],
            'sesso' => $data['sesso'],
            'data_nascita' => $data['data_nascita'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            // 'livello' == 'utente',             // lo voglio per default per chi si registra tramite questa pagina: l'admin infatti lo preregistro nel db con i seeds e i membri dello staff li registro tramite la sezione riservata dell'admin

            'descrizione' => $data['descrizione']
        ]);

    }
}

