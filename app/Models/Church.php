<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Church extends Model
{
    use HasFactory;

    protected $fillable = [
        'latitude', 'longitude',
    ];

    /*
    / Definir Scopes Locais
    */

    // Scope para filtrar por religião
    public function scopeFilterByReligion($query, $religionId)
    {
        return $query->when($religionId, function ($q) use ($religionId) {
            $q->where('religion_id', $religionId);
        });
    }

    // Scope para filtrar por idioma do serviço
    public function scopeFilterByLanguage($query, $languageId)
    {
        return $query->when($languageId, function ($q) use ($languageId) {
            $q->whereHas('services', function ($subQuery) use ($languageId) {
                $subQuery->where('language_id', $languageId);
            });
        });
    }

    // Scope para filtrar dia da semana
    public function scopeFilterByDayOfWeek($query, $dayOfWeek) {
        return $query->when($dayOfWeek, function($q) use ($dayOfWeek){
            $q->whereHas('services', function ($subQuery) use ($dayOfWeek) {
                $subQuery->where('day_of_week', $dayOfWeek);
            });
        });
    }

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
        return $this->belongsToMany(Facility::class, 'church_facility', 'church_id', 'facility_id');
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
