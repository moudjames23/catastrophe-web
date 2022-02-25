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


        $data = array();
        foreach ($alertes  as $key => $alerte)
        {
            $data[$key] = [$alerte->message, $alerte->latitude, $alerte->longitude];
        }


        return view('home', compact('alertes', 'data'));
    }
}
