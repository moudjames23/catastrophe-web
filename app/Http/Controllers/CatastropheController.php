<?php

namespace App\Http\Controllers;

use App\Models\Alea;
use App\Models\Ville;
use App\Models\Catastrophe;
use Illuminate\Http\Request;
use App\Http\Requests\CatastropheStoreRequest;
use App\Http\Requests\CatastropheUpdateRequest;

class CatastropheController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Catastrophe::class);

        $search = $request->get('search', '');

        $catastrophes = Catastrophe::search($search)
            ->paginate(25)
            ->withQueryString();

        return view(
            'app.catastrophes.index',
            compact('catastrophes', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Catastrophe::class);

        $aleas = Alea::pluck('nom', 'id');
        $villes = Ville::pluck('nom', 'id');

        return view('app.catastrophes.create', compact('aleas', 'villes'));
    }

    /**
     * @param \App\Http\Requests\CatastropheStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatastropheStoreRequest $request)
    {
        $this->authorize('create', Catastrophe::class);

        $validated = $request->validated();

        $catastrophe = Catastrophe::create($validated);

        return redirect()
            ->route('catastrophes.edit', $catastrophe)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Catastrophe $catastrophe
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Catastrophe $catastrophe)
    {
        $this->authorize('view', $catastrophe);

        return view('app.catastrophes.show', compact('catastrophe'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Catastrophe $catastrophe
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Catastrophe $catastrophe)
    {
        $this->authorize('update', $catastrophe);

        $aleas = Alea::pluck('nom', 'id');
        $villes = Ville::pluck('nom', 'id');

        return view(
            'app.catastrophes.edit',
            compact('catastrophe', 'aleas', 'villes')
        );
    }

    /**
     * @param \App\Http\Requests\CatastropheUpdateRequest $request
     * @param \App\Models\Catastrophe $catastrophe
     * @return \Illuminate\Http\Response
     */
    public function update(
        CatastropheUpdateRequest $request,
        Catastrophe $catastrophe
    ) {
        $this->authorize('update', $catastrophe);

        $validated = $request->validated();

        $catastrophe->update($validated);

        return redirect()
            ->route('catastrophes.edit', $catastrophe)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Catastrophe $catastrophe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Catastrophe $catastrophe)
    {
        $this->authorize('delete', $catastrophe);

        $catastrophe->delete();

        return redirect()
            ->route('catastrophes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
