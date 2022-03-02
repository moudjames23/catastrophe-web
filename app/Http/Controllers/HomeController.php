<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Alea;
use App\Models\Alerte;
use App\Models\Ville;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $alertes = Alerte::with(['agent', 'alea', 'ville'])
            ->latest()
            ->limit(10)
            ->get();

        $aleasCount = Alea::count();
        $alertesCount = Alerte::count();

        $personnesTouchees = Alerte::select(DB::raw('SUM(alertes.personnes) as personnes'))
            ->first();

        $morts = Alerte::select(DB::raw('SUM(alertes.mort) as decedes'))
            ->first();


        $alerteParRegion = DB::table('alertes')
            ->join('villes', 'alertes.ville_id', 'villes.id')
            ->join('regions', 'villes.region_id', 'regions.id')
            ->select(DB::raw('COUNT(alertes.id) as y'), 'regions.nom as name')
            ->groupBy('name')
            ->get();



        $data = array();
        foreach ($alertes  as $key => $alerte)
        {
            $data[$key] = [$alerte->message, $alerte->latitude, $alerte->longitude];
        }


        // Nombre d'alertes par mois
        $alertesPerMonth = DB::table('alertes')
            ->join('villes', 'alertes.ville_id', 'villes.id')
            ->select(DB::raw("COUNT(alertes.id) as total"), 'villes.nom as prefecture')
            ->groupBy('prefecture')
           ->orderBy('prefecture', 'asc')
            ->get();

        $statAlerteParMoiOnlyMonth = array();
        $statAlerterParMoiOnlyTotal = array();

        for($i = 0; $i < count($alertesPerMonth); $i++)
        {
            $statAlerteParMoiOnlyMonth[] = $alertesPerMonth[$i]->prefecture;
            $statAlerterParMoiOnlyTotal[] = $alertesPerMonth[$i]->total;
        }


        // Nombre d'alertes par alea

        $alerteByAlea = DB::table('alertes')
            ->join('aleas', 'alertes.alea_id', 'aleas.id')
            ->select(DB::raw('COUNT(alertes.id) as y'), 'aleas.nom as name')
            ->groupBy('name')
            ->get();



       // Personnes touchees par prefectures

        $personnes = DB::table('alertes')
            ->join('villes', 'alertes.ville_id', 'villes.id')
            ->select(DB::raw('SUM(alertes.personnes) as y'), 'villes.nom as name')
            ->groupBy('name')
            ->get();

        //Personnes decedees par ville;

        $personnesDecedes = DB::table('alertes')
            ->join('villes', 'alertes.ville_id', 'villes.id')
            ->select(DB::raw('SUM(alertes.mort) as y'), 'villes.nom as name')
            ->groupBy('name')
            ->get();





        return view('home', compact('alertes', 'data',
        'aleasCount', 'alertesCount', 'personnesTouchees', 'morts',
        'statAlerteParMoiOnlyMonth', 'statAlerterParMoiOnlyTotal',
        'alerteByAlea', 'personnes', 'personnesDecedes', 'alerteParRegion'));
    }
}
