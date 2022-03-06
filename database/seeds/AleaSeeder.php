<?php

use App\Models\Alea;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AleaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('aleas')->delete();

        $data = [
          "Inondation",
          "Vent violent",
          "Orage",
          "Sécheresse",
          "Feu de brousse",
          "Glissement de terrain",
          "Tremblement de terre",
          "Épidemie",
        ];

        $images = [
            "public/innondation.jpeg",
            "public/vent.jpeg",
            "public/orage.jpeg",
            "public/secheresse.jpeg",
            "public/feu.jpeg",
            "public/glissement.jpeg",
            "public/tremblement.jpeg",
            "public/epidemie.jpeg",
        ];

        //$url = "https://umap.openstreetmap.fr/fr/map/cartes-des-risques_706209";

        for ($i = 0; $i < count($data); $i++)
        {
            $alea = new Alea();
            $alea->nom = $data[$i];
            $alea->image = $images[$i];
            //$alea->url = $url;
            $alea->save();
        }
    }
}
