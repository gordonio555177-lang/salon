<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Appointment extends Model
{
    protected $fillable = [
        'customer_name', 'customer_email', 'customer_phone',
        'service_id', 'appointment_date', 'appointment_time',
        'total_price', 'payment_status'
    ];
    
    protected $casts = [
        'appointment_date' => 'date',
        'appointment_time' => 'datetime',
        'total_price' => 'decimal:2'
    ];
    
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
    
    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }
}