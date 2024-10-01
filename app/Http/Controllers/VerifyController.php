<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyController extends Controller
{
    public function verify(EmailVerificationRequest $request)
    {

        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'El usuario ya ha sido confirmado'], 400);
        }

        if ($request->user()->markEmailAsVerified()) {
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
