<?php

namespace App\Http\Controllers;

use App\Repositories\ChurchRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * HomeController handles the default landing page requests.
 * It utilizes ChurchRepository for data retrieval and filtering
 * based on user's request criteria.
 */
class HomeController extends Controller
{
    protected $churchRepository;

    /**
     * Injects ChurchRepository dependency to enable data operations
     * for church-related functionalities.
     *
     * @param ChurchRepository $churchRepository Dependency injected ChurchRepository instance.
     */
    public function __construct(ChurchRepository $churchRepository)
    {
        $this->churchRepository = $churchRepository;
    }

    /**
     * Handles the GET request for the home page, retrieving and filtering
     * church data based on provided criteria.
     *
     * It extracts filter criteria from the request, fetches both filtered and featured
     * churches, along with necessary filter options like towns, counties, religions,
     * languages, and facilities to populate filter dropdowns in the view.
     *
     * @param Request $request The incoming request instance, containing potential filters.
     * @return \Illuminate\View\View Returns the view for the home page with relevant data.
     */
    public function index(Request $request) {

        // Extracting filter criteria from the request for church data filtering
        $filters = $request->only(['religion', 'language', 'dayOfWeek', 'facility', 'town', 'county', 'congregationSize']);

        // Fetching filtered churches based on user criteria
        $churches = $this->churchRepository->getFilteredChurches($filters);

        // Fetching additional data needed for rendering the home page effectively
        $featuredChurches = $this->churchRepository->getFeaturedChurches();

        $churches = $this->churchRepository->getFilteredChurches($filters);
        $featuredChurches = $this->churchRepository->getFeaturedChurches();
        $towns = $this->churchRepository->getTowns();
        $counties = $this->churchRepository->getCounties();
        $religions = $this->churchRepository->getReligions();
        $languages = $this->churchRepository->getLanguages();
        $facilities = $this->churchRepository->getFacilities();

        // Returning the home page view, compacting all data for view access
        return view('pages.home', compact('churches', 'featuredChurches', 'religions', 'languages', 'facilities','towns','counties','request'));
    }

}
