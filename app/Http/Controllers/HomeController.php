<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Alea;
use App\Models\Alerte;
use App\Models\Couche;
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
        //$this->middleware('auth');


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $layers = Couche::select('id', 'nom', 'url', 'legende')
            ->orderBy('nom', 'asc')
            ->get()
            ->toArray();

        //dd($layers);

        return view('welcome', compact('layers'));
    }

    public function legendFromUrl($url)
    {
        $couche = Couche::where('url', $url)->first();

        if ($couche != null)
            return view('legend', compact('couche'));

        return '';
    }
}
