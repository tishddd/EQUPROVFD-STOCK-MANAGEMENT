<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_name',
        'model_number',
        'serial_number',
        'status',
        'office_id',
        'employee_id',
    ];

    /**
     * Define the relationship with the Office model.
     */
    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    /**
     * Define the relationship with the Employee (User) model.
     */
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }

    public function batch() {
        return $this->belongsTo(Batch::class);
    }
    
}
