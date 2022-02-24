<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Alea;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = 'Liste des agents';

        $search = $request->get('search', '');

        $agents = Agent::search($search)
            ->latest()
            ->paginate(25)
            ->withQueryString();

        return view('app.agents.index', compact('agents', 'search', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('app.agents.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|min:5',
            'phone' => 'required|min:9|unique:agents',
        ]);


        $agent = new Agent();
        $agent->identifiant = $this->identifiantGenerate();
        $agent->name = $request['name'];
        $agent->phone = $request['phone'];

        $agent->save();

        return redirect()
            ->route('agents.edit', $agent)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {

        return view('app.agents.show', compact('agent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        return view('app.agents.edit', compact('agent'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Agent $agent)
    {
        $this->validate($request, [
            'name' => 'required|min:5',
            'phone' => 'required|min:9|unique:agents,phone,' .$agent->id,
        ]);


        $agent->name = $request['name'];
        $agent->phone = $request['phone'];

        $agent->save();

        return redirect()
            ->route('agents.edit', $agent)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        dd($agent);
    }

    public function identifiantGenerate()
    {
        $data = Agent::select('id')
            ->orderBy('id', 'desc')
            ->first();



        if ($data == null)
            $identifiant =  "0" .rand(10, 99) . '' . rand(10, 99);

        elseif ($data->id < 10)
            $identifiant =  ($data->id) .''. rand(1000, 9999) ;

        else if ($data->id < 100)
            $identifiant =  ($data->id) .''. rand(100, 999);

        return $identifiant;

    }
}
