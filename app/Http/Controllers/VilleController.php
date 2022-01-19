<?php

namespace App\Http\Controllers;

use App\Models\Ville;
use Illuminate\Http\Request;
use App\Http\Requests\VilleStoreRequest;
use App\Http\Requests\VilleUpdateRequest;

class VilleController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Ville::class);

        $search = $request->get('search', '');

        $villes = Ville::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.villes.index', compact('villes', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Ville::class);

        return view('app.villes.create');
    }

    /**
     * @param \App\Http\Requests\VilleStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VilleStoreRequest $request)
    {
        $this->authorize('create', Ville::class);

        $validated = $request->validated();

        $ville = Ville::create($validated);

        return redirect()
            ->route('villes.edit', $ville)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ville $ville
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Ville $ville)
    {
        $this->authorize('view', $ville);

        return view('app.villes.show', compact('ville'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ville $ville
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Ville $ville)
    {
        $this->authorize('update', $ville);

        return view('app.villes.edit', compact('ville'));
    }

    /**
     * @param \App\Http\Requests\VilleUpdateRequest $request
     * @param \App\Models\Ville $ville
     * @return \Illuminate\Http\Response
     */
    public function update(VilleUpdateRequest $request, Ville $ville)
    {
        $this->authorize('update', $ville);

        $validated = $request->validated();

        $ville->update($validated);

        return redirect()
            ->route('villes.edit', $ville)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ville $ville
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Ville $ville)
    {
        $this->authorize('delete', $ville);

        $ville->delete();

        return redirect()
            ->route('villes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
