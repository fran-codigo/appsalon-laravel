<?php

namespace App\Http\Controllers;

use App\Enums\AppointmentStatusEnum;
use App\Models\Appointment;
use App\Models\AppointmentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $appointment = new Appointment();
        $appointment->user_id = Auth::user()->id;
        $appointment->date = $request->date;
        $appointment->time = $request->time;
        $appointment->total = $request->total;
        $appointment->state_id = AppointmentStatusEnum::ACTIVE;
        $appointment->save();

        $id_appointment = $appointment->id;

        $services = $request->services;

        $appointment_service = [];
        foreach ($services as $service) {
            $appointment_service[] = [
                'appointment_id' => $id_appointment,
                'service_id' => $service['id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        AppointmentService::insert($appointment_service);

        return [
            'message' => 'Tu cita ha sigo registrada con exito'
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    public function appointmentsByDate(Request $request)
    {
        // Formatear fecha
        $date = $request->query('date');

        $newDate = Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');

        if (!$newDate) {
            return response()->json([
                'errors' => 'Ha ocurrido un error, intente más tarde'
            ], 400);
        }

        // $dateISO = $newDate->toDateString();

        $appointments = Appointment::where('date', $newDate)->select('time')->get();

        return [
            'data' => $appointments
        ];
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->state_id = AppointmentStatusEnum::CANCELED;
        $appointment->save();

        return [
            'message' => 'La cita se ha cancelado correctamente'
        ];
    }
}
