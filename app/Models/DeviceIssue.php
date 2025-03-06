<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceIssue extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'issue_type',
        'description',
        'status',
        'reported_at'];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
