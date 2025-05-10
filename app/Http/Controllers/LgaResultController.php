<?php

namespace App\Http\Controllers;


use App\Models\Lga;
use App\Models\PollingUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LgaResultController extends Controller
{
    public function index()
    {
        $lgas = Lga::all();
        return view('lga_results.index', compact('lgas'));
    }

    public function showResults(Request $request)
    {
        $lgaId = $request->input('lga_id');
        $selectedLGA = Lga::with(['pollingUnits.results'])->find($lgaId);

        $results = null;
        if ($selectedLGA) {
            $results = $selectedLGA->pollingUnits
                ->flatMap->results
                ->groupBy('party_abbreviation')
                ->map(function ($results) {
                    return (object)[
                        'party_abbreviation' => $results->first()->party_abbreviation,
                        'total_score' => $results->sum('party_score')
                    ];
                })->values();
        }

        $lgas = Lga::all();

        return view('lga_results.index', [
            'lgas' => $lgas,
            'results' => $results,
            'selectedLGA' => $selectedLGA
        ]);
    }
}
