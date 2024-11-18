<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function verify(Request $request)
    {
        $user = User::where('email', $request->email)
            ->whereNull('email_verified_at')
            ->first();

        if (!$user) {
            return response()->json(['message' => 'Token inválido'], 400);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email ya está verificado'], 400);
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return response()->json(['message' => 'El correo se ha verificado correctamente']);
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedemail()) {
            return response()->json(['message' => 'El usuario ya ha sido confirmado'], 400);
        }

        $request->user()->sendEmailVerificatonNotificaction();

        return response()->json(['message' => 'El correo se ha enviado correctamente']);
    }
}
