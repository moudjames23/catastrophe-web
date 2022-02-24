<?php

namespace App\Http\Controllers;

use App\Models\Alerte;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use Illuminate\Http\Request;

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


        for($i = 0; $i < count($alertes); $i++)
            Mapper::map($alertes[$i]['latitude'], $alertes[$i]['longitude'], [
                'zoom' => 15
            ]);

        return view('home', compact('alertes'));
    }
}
