<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Alea;
use App\Models\Alerte;
use App\Models\Ville;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $agentsCount = Agent::count();
        $prefecturesCount = Ville::count();


        $data = array();
        foreach ($alertes  as $key => $alerte)
        {
            $data[$key] = [$alerte->message, $alerte->latitude, $alerte->longitude];
        }


        // Nombre d'alertes par mois
        $alertesPerMonth = Alerte::select(DB::raw("COUNT(*) as total"), DB::raw("DATE_FORMAT(created_at, '%M') as mois"))
            ->groupBy('mois')
            ->orderByRaw("FIELD(mois,'January','February','March','May', 'June','July','August','September','October','November','December')")
            ->get();

        $statAlerteParMoiOnlyMonth = array();
        $statAlerterParMoiOnlyTotal = array();

        for($i = 0; $i < count($alertesPerMonth); $i++)
        {
            $statAlerteParMoiOnlyMonth[] = $alertesPerMonth[$i]['mois'];
            $statAlerterParMoiOnlyTotal[] = $alertesPerMonth[$i]['total'];
        }


        // Nombre d'alertes par alea

        $alerteByAlea = DB::table('alertes')
            ->join('aleas', 'alertes.alea_id', 'aleas.id')
            ->select(DB::raw('COUNT(alertes.id) as y'), 'aleas.nom as name')
            ->groupBy('name')
            ->get();



        //dd($alertesPerMonth);



        return view('home', compact('alertes', 'data',
        'aleasCount', 'alertesCount', 'agentsCount', 'prefecturesCount',
        'statAlerteParMoiOnlyMonth', 'statAlerterParMoiOnlyTotal',
        'alerteByAlea'));
    }
}
