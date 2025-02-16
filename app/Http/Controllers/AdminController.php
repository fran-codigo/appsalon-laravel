<?php

namespace App\Http\Controllers;

use App\Enums\AppointmentStatusEnum;
use App\Http\Resources\ServiceResource;
use App\Models\Appointment;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getAdmin(Request $request)
    {
        $admin = $request->user();
        if ($admin->role_id !== 2) {
            return response([
                'errors' => ['No autorizado']
            ], 422);
        }

        return $admin;
    }

    public function getAppointments()
    {
        $appointments = Appointment::with('user')->with('services')
            ->where('state_id', AppointmentStatusEnum::ACTIVE)
            ->where('date', '>=', Carbon::today())
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->paginate(6);

        return [
            "data" => $appointments
        ];
    }

    public function getServices()
    {
        $services = Service::orderBy('created_at', 'desc')->paginate(10);
        return ServiceResource::collection($services);
    }
}
