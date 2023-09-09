<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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

    public function RegisterPage()
    {
        return view('auth/registerpage');
    }

    public function Registration(Request $request)
    {
        $data = $request->validate([
            'user_name' => ['required', 'string', 'min:4', 'max:10', Rule::unique('users', 'user_name')],
            'email' => ['required', 'string', 'email', 'max:25', 'unique:users'],
            'password' => ['required', 'min:5', 'confirmed','string']
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        auth()->login($user);
        return redirect('/')->with('registersuccess', 'Hesabınız Başarıyla oluşturuldu');
    }

}
