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
use Spatie\Permission\Models\Role;

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
        if(!empty(auth()->user())) {
            redirect()->back();
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data, $type)
    {

        $validators = [
            'teacher' => Validator::make($data, [
                'name' => ['bail', 'alpha_spaces', 'max:255', 'min:3'],
                'username' => ['bail', 'alpha_spaces', 'max:255', 'min:3', 'unique:users'],
                'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['bail','required', 'string', 'min:6', 'confirmed'],
                'dob' => ['bail','required', 'date',],
                'gender' => ['bail','required'],
                'terms' => ['required', 'in:1'],
            ]),
            'corporate' => Validator::make($data, [
                'name' => ['bail', 'alpha_spaces', 'max:255', 'min:3'],
                'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['bail','required', 'string', 'min:6', 'confirmed'],
                'dob' => ['bail','required', 'date',],
                'phone' => ['required','regex:/[0-9+*-*]/'],
            ]),
            'private' => Validator::make($data, [
                'name' => ['bail', 'alpha_spaces', 'max:255', 'min:3'],
                'email' => ['bail', 'required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['bail','required', 'string', 'min:6', 'confirmed'],
                'dob' => ['bail','required', 'date',],
                'phone' => ['required','regex:/[0-9+*-*]/'],
            ])
        ];

        return $validators[$type];
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
            'username' => $data['username'] ?? '',
            'email' => $data['email'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'password' => Hash::make($data['password']),
            'device_token' => $data['device_token'] ?? null,
        ]);
    }

    public function register(Request $request)
    {

        $this->validator($request->all(),'private')->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect("/users/$user->id");
    }

    public function teacher(Request $request)
    {
        $this->validator($request->all(),'teacher')->validate();
        event(new Registered($teacher = $this->create($request->all())));
        $role = Role::where('name', 'teacher')->first();
        $teacher->assignRole([$role->id]);
        return redirect("/users/$teacher->id");
    }
}
