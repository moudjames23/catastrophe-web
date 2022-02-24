<?php

use App\Models\Ville;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('villes')->delete();



        $villes = [
            "Beyla",
            "Boffa",
            "Boké",
            "Coyah",
            "Conakry",
            "Dabola",
            "Dalaba",
            "Dinguiraye",
            "Dixinn",
            "Dubréka",
            "Faranah",
            "Forécariah",
            "Fria",
            "Gaoual",
            "Guéckédou",
            "Kaloum",
            "Kankan",
            "Kérouané",
            "Kindia",
            "Kissidougou",
            "Koubia",
            "Koundara",
            "Kouroussa",
            "Labé",
            "Lélouma",
            "Lola",
            "Macenta",
            "Mali",
            "Mamou",
            "Mandiana",
            "Matam",
            "Matoto",
            "Nzérékoré",
            "Pita",
            "Ratoma",
            "Siguiri",
            "Télimélé",
            "Tougué",
            "Yomou"
        ];


        for($i = 0; $i < count($villes); $i++)
        {
            $ville = new Ville();
            $ville->nom = $villes[$i];
            $ville->save();
        }
    }
}
