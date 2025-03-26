<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    use HasFactory;

    // The table associated with the model
    protected $table = 'user_category';

    // The attributes that are mass assignable
    protected $fillable = [
        'name', 
        'description',
    ];

    // If you want to disable timestamps (created_at and updated_at), set this to false
    // public $timestamps = false;

    /**
     * Define the relationship with the User model
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'category_id');  // Defining inverse relationship
    }
}
