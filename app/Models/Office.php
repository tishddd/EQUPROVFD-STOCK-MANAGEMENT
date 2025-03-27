<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'region',
        'region_code',
    ];

    /**
     * Get the devices associated with this office.
     */
    public function devices()
    {
        return $this->hasMany(Device::class, 'office_id');
    }
}
