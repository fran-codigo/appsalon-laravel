<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ServiceResource(Service::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $data = $request->validated();

        $service = Service::create([
            'name' => $data['name'],
            'price' => $data['price'],
        ]);

        return [
            'message' => 'El servicio se ha creado correctamente',
            'data' => $service
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response([
                'errors' => ['El servicio no existe']
            ], 404);
        }

        return [
            'data' => $service
        ];
    }

    public function update(ServiceRequest $request, string $id)
    {
        $data = $request->validated();

        $service = Service::find($id);

        if (!$service) {
            return response([
                'errors' => ['El servicio no existe']
            ], 404);
        }

        $service->name = $data['name'];
        $service->price = $data['price'];
        $service->available = $data['available'];
        $service->save();

        return [
            'data' => $service
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response([
                'errors' => ['El servicio no existe']
            ], 404);
        }

        $service->available = 0;
        $service->save();

        return [
            'message' => 'El servicio se ha eliminado correctamente'
        ];
    }
}
