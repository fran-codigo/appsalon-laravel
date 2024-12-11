<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        return $user;
    }

    public function getAppointments(Request $request)
    {
        $user = $request->user();

        $appointments = Appointment::where('user_id', $user->id)
            ->where('date', '>=', Carbon::now()->toDateString())
            ->select('id', 'date', 'total')
            ->with('services')
            ->orderBy('date', 'ASC')
            ->get();

        return [
            'data' => $appointments
        ];
    }
}
