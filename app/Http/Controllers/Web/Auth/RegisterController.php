<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware(['auth']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['bail', 'alpha_spaces', 'max:255', 'min:3'],
            'username' => ['required', 'string', 'alpha_dash', 'max:255', 'unique:users'],
            'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['bail','required', 'string', 'min:6', 'confirmed'],
            'dob' => ['bail','required', 'date',],
            'country' => ['bail','required', 'date'],
            'gender' => ['bail','required', 'string'],
            'phone' => ['required','regex:/[0-9+*-*]/'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'] ?? '',
            'username' => $data['username'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'dob' => $data['dob'],
            'country' => $data['country'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
            'device_token' => $data['device_token'] ?? null,
        ]);
    }

    public function register(Request $request)
    {
        
        $this->validator($request->all())->validate();
        
        event(new Registered($user = $this->create($request->all())));
        
        return redirect("/users/$user->id");
    }
}
