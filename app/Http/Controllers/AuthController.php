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
                'errors' => 'Token inválido'
            ], 400);
        }

        $user->is_verified = true;
        $user->token = null;
        $user->save();

        return response()->json([
            'message' => 'Tu cuenta ha sido verificada'
        ]);
    }

    public function forgotPassword(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'errors' => 'El usuario no existe'
            ], 400);
        }

        $user->token = Str::random(32);
        $user->save();

        Mail::send('mail.EmailForgotPassword', ['token' => $user->token, 'name' => $user->name], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Recuperar Contraseña');
        });

        return response()->json([
            "message" => 'Se ha enviado un correo con las acciones a realizar.'
        ]);
    }

    public function verifyPasswordResetToken(Request $request)
    {
        $user = User::where('token', $request->token)->first();

        if (!$user) {
            return response()->json([
                'errors' => 'Token Inválido'
            ], 400);
        }

        return response()->json([
            'message' => 'Token válido'
        ]);
    }
}
