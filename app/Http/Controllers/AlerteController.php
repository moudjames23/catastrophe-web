<?php

namespace App\Http\Controllers;

use App\Exports\AleaAlerteExport;
use App\Exports\AlerteExport;
use App\Models\Alea;
use App\Models\Alerte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;


class AlerteController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->get('search', '');

        $alertes = Alerte::search($search)
            ->orderBy('id', 'desc')
            ->paginate(15)
            ->withQueryString();

        return view('app.alertes.index', compact('search', 'alertes'));
    }


    public function destroy($id)
    {

        $alerte = Alerte::findOrFail($id);

        if ($alerte->image) {
            Storage::delete($alerte->image);
        }

        Alerte::destroy([$alerte->id]);


        return redirect()
            ->route('home')
            ->withSuccess(__('crud.common.removed'));
    }

    public function export()
    {
        return Excel::download(new AlerteExport(), 'alertes.xlsx');
    }

    public function aleaAlerteExport($id)
    {
        $alea = Alea::findOrFail($id);

        return Excel::download(new AleaAlerteExport($id), 'alertes-'.$alea->nom. '.xlsx');
    }
}
