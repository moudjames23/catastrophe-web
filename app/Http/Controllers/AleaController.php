<?php

namespace App\Http\Controllers;

use App\Models\Alea;
use App\Models\Alerte;
use Illuminate\Http\Request;
use App\Http\Requests\AleaStoreRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AleaUpdateRequest;

class AleaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Alea::class);

        $search = $request->get('search', '');

        $aleas = Alea::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();


        return view('app.aleas.index', compact('aleas', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Alea::class);

        return view('app.aleas.create');
    }

    /**
     * @param \App\Http\Requests\AleaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AleaStoreRequest $request)
    {
        $this->authorize('create', Alea::class);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('public');
        }

        $alea = Alea::create($validated);

        return redirect()
            ->route('aleas.edit', $alea)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Alea $alea
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Alea $alea)
    {
        $this->authorize('view', $alea);



        $search = $request->get('search', '');

        $alertes = Alerte::with(['agent', 'alea', 'ville'])
            ->latest()
            ->whereAleaId($alea->id)
            ->paginate(15)
            ->withQueryString();


        $aleasCount = Alea::whereId($alea->id)
            ->count();

        $alertesCount = Alerte::whereAleaId($alea->id)
            ->count();

        $personnesTouchees = Alerte::whereAleaId($alea->id)
            ->select(DB::raw('SUM(alertes.personnes) as personnes'))
            ->first();

        $morts = Alerte::whereAleaId($alea->id)
            ->select(DB::raw('SUM(alertes.mort) as decedes'))
            ->first();

        // Personnes touchees par prefectures

        $personnes = DB::table('alertes')
            ->join('villes', 'alertes.ville_id', 'villes.id')
            ->select(DB::raw('SUM(alertes.personnes) as y'), 'villes.nom as name')
            ->where('alertes.alea_id', $alea->id)
            ->groupBy('name')
            ->get();

        //Personnes decedees par ville;

        // Nombre d'alertes par mois
        $alertesDecedeParVille = DB::table("alertes")
            ->join('villes', 'alertes.ville_id', 'villes.id')
            ->select(DB::raw('SUM(alertes.mort) as mort'), 'villes.nom as ville')
            ->where('alertes.alea_id', $alea->id)
            ->groupBy('ville')
            ->get();

        $statTotalMort = array();
        $statTotalVille = array();

        for($i = 0; $i < count($alertesDecedeParVille); $i++)
        {

            $statTotalMort[] = $alertesDecedeParVille[$i]->mort;
            $statTotalVille[] = $alertesDecedeParVille[$i]->ville;

        }


        return view('app.aleas.show', compact( 'alertes',
            'search',
            'alea',
            'aleasCount',
            'alertesCount',
            'personnesTouchees',
            'morts',
            'personnes',
            'statTotalMort', 'statTotalVille'
        ));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Alea $alea
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Alea $alea)
    {
        $this->authorize('update', $alea);

        return view('app.aleas.edit', compact('alea'));
    }

    /**
     * @param \App\Http\Requests\AleaUpdateRequest $request
     * @param \App\Models\Alea $alea
     * @return \Illuminate\Http\Response
     */
    public function update(AleaUpdateRequest $request, Alea $alea)
    {
        $this->authorize('update', $alea);

        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($alea->image) {
                Storage::delete($alea->image);
            }

            $validated['image'] = $request->file('image')->store('public');
        }

        $alea->update($validated);

        return redirect()
            ->route('aleas.edit', $alea)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Alea $alea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Alea $alea)
    {
        $this->authorize('delete', $alea);

        if ($alea->image) {
            Storage::delete($alea->image);
        }

        $alea->delete();

        return redirect()
            ->route('aleas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
