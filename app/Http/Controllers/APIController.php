<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Alea;
use App\Models\Alerte;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use function GuzzleHttp\Promise\all;

class APIController extends Controller
{
    public function home()
    {
        $aleas = Alea::has('catastrophes')
            ->select('id', 'nom', 'url', 'image')
            ->get();

        $villes = Ville::has('catastrophes')
            ->select('id', 'nom')
            ->get();


        $data = [
            'aleas' => $aleas,
            'villes' => $villes
        ];


        return response()->json($data);
    }

    public function alea($id)
    {
        $alea = Alea::findOrFail($id);

        $catastrophes = DB::table('catastrophes')
            ->join('villes', 'catastrophes.ville_id', 'villes.id')
            ->select('valeur', 'villes.nom')
            ->where('catastrophes.alea_id', $id)
            ->get();

        return response()->json($catastrophes);
    }

    public function ville($id)
    {
        $ville = Ville::findOrFail($id);

        $catastrophes = DB::table('catastrophes')
            ->join('villes', 'catastrophes.ville_id', 'villes.id')
            ->join('aleas', 'catastrophes.alea_id', 'aleas.id')
            ->select('aleas.nom', 'valeur',  'aleas.url')
            ->where('catastrophes.ville_id', $id)
            ->get();

        return response()->json($catastrophes);
    }

    public function sync(Request $request)
    {
        $ville = Ville::whereId($request['ville_id'])->first();
        $alea = Alea::whereId($request['alea_id'])->first();
        $agent = Agent::whereId($request['agent_id'])->first();

        $alerte = new Alerte();
        $alerte->ville_id = $ville->id;
        $alerte->alea_id = $alea->id;
        $alerte->agent_id = $agent->id;
        $alerte->superficie = $request['superficie'];
        $alerte->date = $request['date'];
        $alerte->localite = $request['localite'];
        $alerte->personnes = $request['personne'];
        $alerte->latitude = $request['latitude'];
        $alerte->longitude = $request['longitude'];

        if ($request->hasFile('image')) {

            $alerte->image = $request->file('image')->store('public');
        }

        $alerte->save();

        return response()->json('Success');


    }
}
