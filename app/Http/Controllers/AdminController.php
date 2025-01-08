<?php

namespace App\Http\Controllers;

use App\Enums\AppointmentStatusEnum;
use App\Models\Appointment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getAdmin(Request $request)
    {
        $admin = $request->user();
        return $admin;
    }

    public function getAppointments()
    {
        $appointments = Appointment::with('services')
            ->where('state_id', AppointmentStatusEnum::ACTIVE)
            ->where('date', '>=', Carbon::today())
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->paginate(6);

        return [
            "data" => $appointments
        ];
    }
}
