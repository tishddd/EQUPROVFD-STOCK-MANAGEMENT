<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model {
    use HasFactory;

    protected $fillable = [
        'batch_id',
        'batch_date',
        'description'
    ];

     /**
     * Get the devices associated with this batch.
     */

    public function devices() {
        return $this->hasMany(Device::class);
    }
    
}
