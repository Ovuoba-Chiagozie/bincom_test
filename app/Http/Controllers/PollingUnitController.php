<?php

namespace App\Http\Controllers;

use App\Models\Lga;
use App\Models\Ward;
use App\Models\Party;
use App\Models\PollingUnit;
use Illuminate\Http\Request;
use App\Models\AnnouncedPuResult;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;


class PollingUnitController extends Controller
{
    public function index(Request $request)
    {
        // noticed a lot of polling units names were just empty space so filtering them here before sending it to the frontend
        $pollingUnits = PollingUnit::whereNotNull('polling_unit_name')
            ->where('polling_unit_name', '!=', '')
            ->whereRaw("TRIM(polling_unit_name) != ''")
            ->get();
        $results = null;
        $selectedPU = null;

        if ($request->isMethod('post') && $request->polling_unit_id) {
            $selectedPU = PollingUnit::with('results')->find($request->polling_unit_id);
            $results = $selectedPU ? $selectedPU->results : null;
        }

        return view('polling_units.index', compact('pollingUnits', 'results', 'selectedPU'));
    }

    public function create()
    {
        $wards = Ward::with('lga')->get();
        $lgas = Lga::all();
        $parties = Party::all();

        return view('polling_units.create', compact('wards', 'lgas', 'parties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'polling_unit_name' => 'required|string|max:255',
            'ward_id' => 'required|exists:ward,ward_id',
            'lga_id' => 'required|exists:lga,lga_id',
            'party_scores' => 'required|array',
            'party_scores.*' => 'required|numeric',
        ]);

        $dateEntered = Carbon::now()->format('Y-m-d H:i:s');
        $ipAddress = request()->ip();

        $pollingUnit = PollingUnit::create([
            'polling_unit_name' => $request->polling_unit_name,
            'ward_id' => $request->ward_id,
            'lga_id' => $request->lga_id,
            'date_entered' => $dateEntered,
            'user_ip_address' => $ipAddress
        ]);


        foreach ($request->party_scores as $partyAbbreviation => $score) {
            // the party_abbreviation column for the announced_pu_result table has a maximum character length. 
            // Didn't want to make any chnages to the db so it can be tested on your own end. 
            // And the only party that exceeds that length is just labour so that's why I am changing it here before saving to db
            if ($partyAbbreviation === 'LABOUR') {
                $partyAbbreviation = 'LABO';
            }

            AnnouncedPuResult::create([
                'polling_unit_uniqueid' => $pollingUnit->uniqueid,
                'party_abbreviation' => $partyAbbreviation,
                'party_score' => $score,
                'date_entered' => $dateEntered,
                'user_ip_address' => $ipAddress
            ]);
        }

        return redirect()->route('polling-units.create')->with('success', 'Polling unit successfully created!');
    }
}
