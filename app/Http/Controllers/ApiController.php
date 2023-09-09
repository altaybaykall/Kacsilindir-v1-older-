<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public  function index() {
        $brands = Brands::Orderby('created_at','ASC')->take(6)->get()->makeHidden(['content','logo','updated_at']);
        return response()->json($brands);

    }



    public function register(Request $request) {
       $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);



        $user = User::Create([
            'name' => $request->name,
            'email'=>$request->name ,
            'password' => $request->password ,
        ]);
        return response()->json($user);

    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['user_name' => $data['name'], 'password' => $data['password']])) {
            $user = User::where('user_name', $data['name'])->first();
            $authToken = $user->createToken('auth-token')->plainTextToken;
            return response()->json([
                'access-token' => $authToken,
                'user' => $user
            ]);
        }

        return response()->json([
            'message' => 'Geçersiz Bilgiler'
        ], 422);
    }
}
