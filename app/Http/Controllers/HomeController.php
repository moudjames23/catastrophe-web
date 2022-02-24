<?php

namespace App\Http\Controllers;

use App\Models\Alerte;
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

        return view('home', compact('alertes'));
    }
}
