<?php

namespace App\Http\Controllers;

use App\Models\Alea;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{
    public function home()
    {
        $aleas = Alea::has('catastrophes')
            ->select('id', 'nom', 'url')
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
}
