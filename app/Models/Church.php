<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use HasFactory;

    // Relação Church-User: muitos-para-um
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relação Church-Religion: muitos-para-um
    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    // Relação Church-Service: um-para-muitos
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    // Relação Church-Photo: um-para-muitos
    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    // Relação Church-Event: um-para-muitos
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function facilities()
    {
        return $this->belongsToMany(Facility::class, 'church_facility');
    }
}
