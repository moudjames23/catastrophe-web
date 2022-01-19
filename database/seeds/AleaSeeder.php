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
          "feux de brousse",
          "Glissement",
        ];

        $url = "p.openstreetmap.fr/fr/map/organisation-des-femmes-et-des-jeunes-filles-leade_517884#12/9.5962/-13.6625";

        for ($i = 0; $i < count($data); $i++)
        {
            $alea = new Alea();
            $alea->nom = $data[$i];
            $alea->url = $url;
            $alea->save();
        }
    }
}
