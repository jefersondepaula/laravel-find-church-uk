<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function churches()
    {
        return $this->belongsToMany(Church::class, 'church_facility', 'facility_id', 'church_id');
    }
}
