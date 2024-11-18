<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $token = Str::random(32);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'token' => $token
        ]);

        Mail::send('mail.emailVerify', ['token' => $token, 'name' => $request->get('name')], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Verificacion de email');
        });

        return [
            'token' => $user->createToken('token')->plainTextToken,
            'message' => 'El usuario se creo correctamente, revisa tu email.'
        ];
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if (!Auth::attempt($data)) {
            return response([
                'errors' => ['El email o la contraseña son incorrectos']
            ], 422);
        }

        $user = Auth::user();

        if (!$user->is_verified) {
            return response()->json([
                'errors' => ['Confirma tu cuenta antes de hacer login']
            ], 422);
        }

        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return ['user' => null];
    }

    public function verifyUser(Request $request)
    {
        $user = User::where('token', $request->token)->first();

        if (!$user) {
            return response()->json([
                'error' => 'Token inválido'
            ], 400);
        }

        $user->is_verified = true;
        $user->token = null;
        $user->save();

        return response()->json([
            'message' => 'Tu cuenta ha sido verificada'
        ]);
    }
}
