<?php

namespace App\Http\Controllers;

use App\Models\Alerte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlerteController extends Controller
{
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
}
