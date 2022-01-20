<?php

namespace App\Http\Controllers;

use App\Models\Alea;
use App\Models\Catastrophe;
use App\Models\Ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class ExcelCatastropheController extends Controller
{

    private $error = array();

    public function form()
    {
        return view('app.excel.import');
    }

    public function import(Request $request)
    {
        $this->validate($request, [
            'excel' => 'nullable|file|mimes:xlsx',
        ]);

        if ($request->hasFile('excel')) {


            $path = $request->file('excel')->getRealPath();

            $COLUMN_VILLE = "Ville";

            $COLUMN_INONDATION = "Inondation";
            $COLUMN_VENT_VIOLENT = "Vent violent";
            $COLUMN_ORAGE = "Orage";
            $COLUMN_SECHERESSE = "Sécheresse";
            $COLUMN_FEU_BROUSSE = "Feu de brousse";
            $COLUMN_GLISSEMENT = "Glissement";

            $inodation = Alea::where('nom', $COLUMN_INONDATION)->first();
            $ventViolent = Alea::where('nom', $COLUMN_VENT_VIOLENT)->first();
            $orage = Alea::where('nom', $COLUMN_ORAGE)->first();
            $secheresse = Alea::where('nom', $COLUMN_SECHERESSE)->first();
            $feuBrousse = Alea::where('nom', $COLUMN_FEU_BROUSSE)->first();
            $glissement = Alea::where('nom', $COLUMN_GLISSEMENT)->first();

            $compteur = 0;

            FastExcel::import($path, function ($data) use (
                $COLUMN_VILLE, $COLUMN_INONDATION, $COLUMN_VENT_VIOLENT, $COLUMN_ORAGE,
                $COLUMN_SECHERESSE, $COLUMN_FEU_BROUSSE, $COLUMN_GLISSEMENT, $compteur,
                $inodation, $ventViolent, $orage, $secheresse, $feuBrousse, $glissement
            ) {
                $compteur++;


                if ($compteur == 1) {

                    $this->errorColumn($COLUMN_VILLE, $data, $compteur);
                    $this->errorColumn($COLUMN_INONDATION, $data, $compteur);
                    $this->errorColumn($COLUMN_VENT_VIOLENT, $data, $compteur);
                    $this->errorColumn($COLUMN_ORAGE, $data, $compteur);
                    $this->errorColumn($COLUMN_SECHERESSE, $data, $compteur);
                    $this->errorColumn($COLUMN_FEU_BROUSSE, $data, $compteur);
                    $this->errorColumn($COLUMN_GLISSEMENT, $data, $compteur);

                }

                if(!count($this->error))
                {

                    $ville = Ville::where('nom', $data[$COLUMN_VILLE])->first();

                    if ($ville == null)
                    {
                        $ville = new Ville();
                        $ville->nom = $data[$COLUMN_VILLE];
                        $ville->save();
                    }



                    if (!empty($data[$COLUMN_INONDATION]))
                    {
                        $catastrophe = new Catastrophe();
                        $catastrophe->ville_id = $ville->id;
                        $catastrophe->alea_id = $inodation->id;
                        $catastrophe->valeur = $data[$COLUMN_INONDATION];
                        $catastrophe->save();
                    }



                    if (!empty($data[$COLUMN_VENT_VIOLENT]))
                    {
                        $catastrophe = new Catastrophe();
                        $catastrophe->ville_id = $ville->id;
                        $catastrophe->alea_id = $ventViolent->id;
                        $catastrophe->valeur = $data[$COLUMN_VENT_VIOLENT];
                        $catastrophe->save();
                    }



                    if (!empty($data[$COLUMN_ORAGE]))
                    {
                        $catastrophe = new Catastrophe();
                        $catastrophe->ville_id = $ville->id;
                        $catastrophe->alea_id = $orage->id;
                        $catastrophe->valeur = $data[$COLUMN_ORAGE];
                        $catastrophe->save();
                    }



                    if (!empty($data[$COLUMN_SECHERESSE]))
                    {
                        $catastrophe = new Catastrophe();
                        $catastrophe->ville_id = $ville->id;
                        $catastrophe->alea_id = $secheresse->id;
                        $catastrophe->valeur = $data[$COLUMN_SECHERESSE];
                        $catastrophe->save();
                    }



                    if (!empty($data[$COLUMN_FEU_BROUSSE]))
                    {
                        $catastrophe = new Catastrophe();
                        $catastrophe->ville_id = $ville->id;
                        $catastrophe->alea_id = $feuBrousse->id;
                        $catastrophe->valeur = $data[$COLUMN_FEU_BROUSSE];
                        $catastrophe->save();
                    }



                    if (!empty($data[$COLUMN_GLISSEMENT]))
                    {
                        $catastrophe = new Catastrophe();
                        $catastrophe->ville_id = $ville->id;
                        $catastrophe->alea_id = $glissement->id;
                        $catastrophe->valeur = $data[$COLUMN_GLISSEMENT];
                        $catastrophe->save();
                    }

                }
            });




        }

        if(count($this->error))
        {
            Session::flash('message', array_unique($this->error));
            return  redirect(route('type-echantillon.excel.form'));
        }

        return redirect(route('catastrophes.index'));
    }

    public function errorColumn($column, $data, $ligne)
    {
        if (!isset($data[$column]))
            $this->error[] = "La colonne " . $column . " de la ligne " .$ligne. " n'exsite pas ou est mal écrite";
    }
}
