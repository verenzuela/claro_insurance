<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Providers\RouteServiceProvider;
use App\Models\User;
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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showRegistrationForm()
    {
        $countries = Country::all();
        return view('auth.register', ['countries' => $countries]);
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/[a-zA-Z0-9]*[@$!%*#?&.]/'
            ],
            'name' => ['required', 'string', 'max:100'],
            'phone_number' => ['nullable', 'string', 'min:8', 'max:10'],
            'num_docm_identity' => ['required', 'string', 'max:11'],
            'city_id' => ['required', 'exists:cities,id'],
            'date_of_birth' => ['required', 'date', 'olderThan']
        ],
        [
            'password.regex' => __('validation.password_conditions'),
            'date_of_birth.olderThan' => __('validation.olderThan'),
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
            'phone_number' => $data['phone_number'],
            'num_docm_identity' => $data['num_docm_identity'],
            'city_id' => $data['city_id'],
            'date_of_birth' => date('Y-m-d', strtotime($data['date_of_birth']) )
        ]);
    }
}
