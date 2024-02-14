<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Church;
use App\Models\Facility;
use App\Models\Religion;
use App\Models\ServiceLanguage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //
    // public function index(Request $request) {

    //     $query = Church::query();

    //     // Filtro por religião
    //     if ($request->has('religion') && !empty($request->religion)) {
    //         $query->where('religion_id', $request->religion);
    //     }

    //      // Filtro por idioma do serviço
    //     // Supondo que você tenha uma relação entre Church e ServiceLanguage, e cada serviço tem um 'language_id'
    //     if ($request->has('language') && !empty($request->language)) {
    //         // Assumindo que a relação entre Church e Service (serviços) permite filtrar por idioma
    //         $query->whereHas('services', function ($subQuery) use ($request) {
    //             $subQuery->where('language_id', $request->language);
    //         });
    //     }

    //     // Filtro por Dia da Semana
    //     if ($request->has('dayOfWeek') && $request->dayOfWeek !== '') {
    //         $query->whereHas('services', function ($subQuery) use ($request) {
    //             $subQuery->where('day_of_week', $request->dayOfWeek);
    //         });
    //     }

    //     $query = Church::with('facilities');
    //     // Filtro por Facilidade
    //     if ($request->has('facility') && !empty($request->facility)) {
    //         $query->whereHas('facilities', function ($subQuery) use ($request) {
    //             $subQuery->where('facilities.id', $request->facility);
    //         });
    //     }

    //     $churches = $query->get();

    //     // Buscar igrejas em destaque
    //     $featuredChurches = Church::where('is_featured', 1)->take(5)->get();

    //     // Opcoes para filtros
    //     $religions = Religion::all();
    //     $languages = ServiceLanguage::all();
    //     $facilities = Facility::all();

    //     return view('home', compact('churches','featuredChurches','religions','languages','facilities'));
    // }

    public function index(Request $request) {
        // Inicia a query com um pré-carregamento das relações necessárias

        $query = Church::with(['facilities', 'services'])
            ->filterByReligion($request->religion)
            ->filterByLanguage($request->language)
            ->filterByDayOfWeek($request->dayOfWeek);

        // Filtro por religião
        // if ($request->filled('religion')) {
        //     $query->where('religion_id', $request->religion);
        // }

        // Filtro por idioma do serviço
        // if ($request->filled('language')) {
        //     $query->whereHas('services', function ($subQuery) use ($request) {
        //         $subQuery->where('language_id', $request->language);
        //     });
        // }

        // Filtro por Dia da Semana
        if ($request->filled('dayOfWeek')) {
            $query->whereHas('services', function ($subQuery) use ($request) {
                $subQuery->where('day_of_week', $request->dayOfWeek);
            });
        }

        // Filtro por Facilidade
        if ($request->filled('facility')) {
            $query->whereHas('facilities', function ($subQuery) use ($request) {
                $subQuery->where('facilities.id', $request->facility);
            });
        }

        if ($request->filled('town')) {
            $query->whereHas('address', function ($subQuery) use ($request) {
                $subQuery->where('town', $request->town);
            });
        }

        if ($request->filled('county')) {
            $query->whereHas('address', function ($subQuery) use ($request) {
                $subQuery->where('county', $request->county);
            });
        }

        if ($request->filled('congregationSize')) {
            switch ($request->congregationSize) {
                case '1':
                    $query->where('congregation_size', '<', 50);
                    break;
                case '2':
                    $query->whereBetween('congregation_size', [50, 100]);
                    break;
                case '3':
                    $query->whereBetween('congregation_size', [100, 150]);
                    break;
                case '4':
                    $query->whereBetween('congregation_size', [150, 200]);
                    break;
                case '5':
                    $query->whereBetween('congregation_size', [200, 250]);
                    break;
                case '6':
                    $query->whereBetween('congregation_size', [250, 300]);
                    break;
                case '7':
                    $query->whereBetween('congregation_size', [300, 350]);
                    break;
                case '8':
                    $query->whereBetween('congregation_size', [350, 400]);
                    break;
                case '9':
                    $query->whereBetween('congregation_size', [400, 450]);
                    break;
                case '10':
                    $query->whereBetween('congregation_size', [450, 500]);
                    break;
            }
        }



        // Executa a query e obtém as igrejas
        $churches = $query->get();

        // Buscar igrejas em destaque, separadamente da query principal, incluindo suas fotos
        $featuredChurches = Church::with('photos')->where('is_featured', 1)->take(5)->get();

        // Buscar cidades e condados unicos
        $towns = Address::select('town')->distinct()->orderBy('town')->get()->pluck('town');
        $counties = Address::select('county')->distinct()->orderBy('county')->get()->pluck('county');

        // Opções para filtros
        $religions = Religion::whereHas('churches')->get();
        $languages = ServiceLanguage::all(); // Assumindo que você tem essa relação configurada
        $facilities = Facility::all();

        return view('pages.home', compact('churches', 'featuredChurches', 'religions', 'languages', 'facilities','towns','counties'));
    }

}
