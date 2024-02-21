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

    // Scope para filtar por facilidade
    public function scopeFilterByFacility($query, $facilityId) {
        return $query->when($facilityId, function($q) use ($facilityId){
            $q->whereHas('facilities', function($subQuery) use ($facilityId){
                $subQuery->where('facility_id', $facilityId);
            });
        });
    }

    // Scope filter by town
    public function scopeFilterByTown($query, $town) {
        return $query->when($town, function ($q) use ($town) {
            $q->whereHas('address', function ($subQuery) use ($town) {
                $he = $subQuery->where('town', '=', $town);

                // dd($he->toSql(), $he->getBindings());
            });
        });
    }

    public function scopeFilterByCounty($query, $county) {
        return $query->when($county, function ($q) use ($county) {
            $q->whereHas('address', function ($subQuery) use ($county) {
                $subQuery->where('county', '=', $county);
            });
        });
    }

    public function scopeFilterByCongregationSize($query, $size) {
        return $query->when($size, function ($q) use ($size) {
            switch ($size) {
                case '1':
                    $q->where('congregation_size', '<', 50);
                    break;
                case '2':
                    $q->whereBetween('congregation_size', [50, 100]);
                    break;
                case '3':
                    $q->whereBetween('congregation_size', [100, 150]);
                    break;
                case '4':
                    $q->whereBetween('congregation_size', [150, 200]);
                    break;
                case '5':
                    $q->whereBetween('congregation_size', [200, 250]);
                    break;
                case '6':
                    $q->whereBetween('congregation_size', [250, 300]);
                    break;
                case '7':
                    $q->whereBetween('congregation_size', [300, 350]);
                    break;
                case '8':
                    $q->whereBetween('congregation_size', [350, 400]);
                    break;
                case '9':
                    $q->whereBetween('congregation_size', [400, 450]);
                    break;
                case '10':
                    $q->whereBetween('congregation_size', [450, 500]);
                    break;
                default:

                    break;
            }
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
