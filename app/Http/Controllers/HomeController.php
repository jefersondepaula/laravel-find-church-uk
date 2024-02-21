<?php

namespace App\Http\Controllers;

use App\Repositories\ChurchRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    protected $churchRepository;


    public function __construct(ChurchRepository $churchRepository)
    {
        $this->churchRepository = $churchRepository;
    }

    public function index(Request $request) {

        // Extracting filter criteria from the request
        $filters = $request->only(['religion', 'language', 'dayOfWeek', 'facility', 'town', 'county', 'congregationSize']);

        // Fetching filtered churches using the repository
        $churches = $this->churchRepository->getFilteredChurches($filters);

        // Assuming getFeaturedChurches, getTowns, getCounties, and getFilterOptions are methods within the repository
        $featuredChurches = $this->churchRepository->getFeaturedChurches();

        $churches = $this->churchRepository->getFilteredChurches($filters);
        $featuredChurches = $this->churchRepository->getFeaturedChurches();
        $towns = $this->churchRepository->getTowns();
        $counties = $this->churchRepository->getCounties();
        $religions = $this->churchRepository->getReligions();
        $languages = $this->churchRepository->getLanguages();
        $facilities = $this->churchRepository->getFacilities();

        return view('pages.home', compact('churches', 'featuredChurches', 'religions', 'languages', 'facilities','towns','counties','request'));
    }

}
