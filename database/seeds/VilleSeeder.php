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



        $villes = ['Boké','Kamsar', 'Coyah', 'Boffa','Koba', 'Dubréka', 'Forécariah', 'Fria', 'Kindia', 'Télimélé',
            'Dalaba',  'Labé', 'Lélouma', 'Mali', 'Mamou', 'Pita', 'Koubia', 'Tougué', 'Gaoual',
            'Kankan', 'Kérouane', 'Kouroussa','Koundara', 'Mandiana', 'Siguiri', 'Dabola', 'Dinguiraye', 'Faranah',
            'Beyla', 'Guéckédou', 'Kissidougou', 'Lola', 'Macenta', 'Nzérékoré', 'Yomou'
        ];


        for($i = 0; $i < count($villes); $i++)
        {
            $ville = new Ville();
            $ville->nom = $villes[$i];
            $ville->save();
        }
    }
}
