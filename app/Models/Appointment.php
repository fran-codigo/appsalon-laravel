<?php

namespace App\Models;

use App\Enums\AppointmentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'time',  'total', 'state_id', 'user_id'];

    protected $casts = ['status_id' => AppointmentStatusEnum::class];

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function services()
    {
        return $this->belongsToMany(Service::class, 'appointments_services')
            ->select(['services.id', 'services.name', 'services.price']);
    }


}
