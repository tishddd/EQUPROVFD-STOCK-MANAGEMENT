<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'employee_id',
        'region',
        'customer_tin',
        'date_sent',
        'status',
    ];

    /**
     * Get the device associated with this transaction.
     */
    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    /**
     * Get the employee (user) who handled this transaction.
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
