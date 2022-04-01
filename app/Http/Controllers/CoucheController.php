<?php

namespace App\Http\Controllers;


use App\Models\Alea;
use App\Models\Couche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class CoucheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $search = $request->get('search', '');

        $couches = Couche::search($search)
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('app.couches.index', compact('couches', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $couche = new Couche();
        return view('app.couches.create', compact('couche'));
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
            'nom' => 'required|min:3|unique:couches',
            'kml' => 'required',
            'legende' => 'required|image'
        ]);


        $couche = new Couche();
        $couche->nom = $request['nom'];

       if ($request->hasFile('kml') && $request->hasFile('legende'))
       {
           $kml = $this->saveFile($request, $request['kml'], 'kml');
           $legende = $this->saveFile($request, $request['legende'],'legende');


          $couche->url = $kml;
          $couche->legende = $legende;
          $couche->save();

           return redirect()
               ->route('couches.index', $couche)
               ->withSuccess(__('crud.common.created'));
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $couche = Couche::findOrFail($id);

        $file = public_path(). '/kml/' .$couche->url;

        if ($couche->url) {
            File::delete($file);
        }

        if ($couche->legende)
        {
            File::delete(public_path().'/legende/' .$couche->legende);
        }

        $couche->delete();

        return redirect()
            ->route('couches.index')
            ->withSuccess(__('crud.common.removed'));
    }



    public function saveFile(Request $request, $file, $path)
    {
        $extension = $file->getClientOriginalExtension();

        $uniqueFileName = str_replace(' ', '-', $request['nom']).'.' .$extension;

        $file->move(public_path(). '/' .$path, $uniqueFileName);

        return $uniqueFileName;

    }
}
