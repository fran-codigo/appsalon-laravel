<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['date', 'time',  'total', 'state', 'user_id'];

    public function services()
    {
        return $this->belongsToMany(Service::class, 'appointments_services')->select('name');
    }
}
