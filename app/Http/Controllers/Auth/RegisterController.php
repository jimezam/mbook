<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     * (Added rules for first/lastname and country fields) -jimezam
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'country' => 'required|exists:countries,id',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Show the application registration form.
     * (added to insert country data to the auth.register view) -jimezam
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        $colombia = \App\Country::where('iso2', 'CO')->get();
        $other = \App\Country::orderBy('name', 'asc')->get();

        $countries = $colombia->merge($other)->all();
                        ;

        // $countries = array_merge(['45' => 'Colombia'], 
        //                 \App\Country::orderBy('name', 'asc')->pluck('name', 'id')->toArray());

        return view('auth.register', compact('countries'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user =  User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'country_id' => $data['country'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }
}
