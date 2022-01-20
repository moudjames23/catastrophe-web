<?php

use App\Models\Alea;
use Illuminate\Database\Seeder;

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
          "Glissement",
        ];

        $url = "https://umap.openstreetmap.fr/fr/map/cartes-des-risques_706209";

        for ($i = 0; $i < count($data); $i++)
        {
            $alea = new Alea();
            $alea->nom = $data[$i];
            $alea->url = $url;
            $alea->save();
        }
    }
}
