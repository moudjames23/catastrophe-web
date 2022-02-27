<?php

use App\Models\Agent;
use App\Models\Alerte;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;

class AlerteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('agents')->delete();

        $agent = new Agent();
        $agent->name = "DIALLO Mamoudou";
        $agent->phone = "620029489";
        $agent->identifiant = "12345";
        $agent->save();


        DB::table('alertes')->delete();


        $faker = Faker::create();

        for($i = 1; $i < 100; $i++)
        {
            $alerte = new Alerte();
            $alerte->ville_id = rand(1, 33);
            $alerte->sous_prefecture_id = rand(1, 337);
            $alerte->alea_id = rand(1, 6);
            $alerte->agent_id = 1;
            $alerte->mort = rand(0, 30);
            $alerte->superficie = rand(100, 1500);
            $alerte->date = $this->randDate();
            $alerte->personnes = rand(100, 10000);

            $gps = $this->fakeGps($faker);

            $alerte->latitude = $gps[0];
            $alerte->longitude = $gps[1];
            $alerte->localite = "";
            $alerte->image = "";
            $alerte->save();
        }



    }

    private function fakeGps($faker)
    {
        $lang = 9.509167;
        $long = -13.712222;


        $latitude = $faker->latitude($min = ($lang - (rand(0,20) / 1000)), $max = ($lang + (rand(0,20) / 1000)));
        $longitude = $faker->longitude($min = ($long - (rand(0,20) / 1000)), $max = ($long + (rand(0,20) / 1000)));

        return [$latitude, $longitude];
    }

    private function randDate()
    {
        $years = [2021, 2021];

        $annee = $years[rand(0, 1)];
        $mois = rand(1, 12);
        $jour = rand(1, 28);

        if($annee == 2022)
        {
            $now = Carbon::now();

            $mois = rand(1, $now->month);
            $jour = rand(1, $now->day);
        }

        return Carbon::createFromDate($annee, rand(1, $mois), rand(1, $jour));
    }

}
