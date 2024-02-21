<?php

namespace App\Repositories;

use Illuminate\Http\Request;

interface ChurchRepositoryInterface
{
    public function getFilteredChurches($filters);
    public function getFeaturedChurches();
}
