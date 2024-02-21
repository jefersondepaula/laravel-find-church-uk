<?php

namespace App\Repositories;

use App\Models\Address;
use App\Models\Church;
use App\Models\Facility;
use App\Models\Religion;
use App\Models\ServiceLanguage;
use App\Repositories\ChurchRepositoryInterface;

class ChurchRepository implements ChurchRepositoryInterface
{
    public function getFeaturedChurches()
    {
        return Church::where('is_featured', true)->take(10)->get();
    }

    public function getFilteredChurches($filters)
    {
        $query = Church::with(['facilities', 'services']);

        // Filter by religion
        if (!empty($filters['religion'])) {
            $query->filterByReligion($filters['religion']);
        }

        // Filter by language
        if (!empty($filters['language'])) {
            $query->filterByLanguage($filters['language']);
        }

        // Apply the facility filter if provided
        if (!empty($filters['facility'])) {
            $query->filterByFacility($filters['facility']);
        }

        // Apply the town filter if provided
        if (!empty($filters['town'])) {
          $query->filterByTown($filters['town'])->get();
        }

        if (!empty($filters['dayOfWeek'])) {
            $query->filterByDayOfWeek($filters['dayOfWeek']);
        }

        if (!empty($filters['county'])) {
            $query->filterByCounty($filters['county']);
        }

        if (!empty($filters['congregationSize'])) {
            $query->filterByCongregationSize($filters['congregationSize']);
        }



        return $query->get();
    }

    public function getTowns()
    {
        return Address::select('town')->distinct()->orderBy('town')->pluck('town');
    }

    public function getCounties()
    {
        return Address::select('county')->distinct()->orderBy('county')->pluck('county');
    }

    public function getReligions()
    {
        return Religion::whereHas('churches')->get();
    }

    public function getLanguages()
    {
        return ServiceLanguage::all();
    }

    public function getFacilities()
    {
        return Facility::all();
    }
}
