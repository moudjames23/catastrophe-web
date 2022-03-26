<?php

use App\Models\Agent;
use App\Models\Alea;
use App\Models\Alerte;
use App\Models\SousPrefecture;
use App\Models\Ville;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use Faker\Factory as Faker;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class AlerteSeeder extends Seeder
{

    private $error = array();

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

        $path = public_path('alertes.xlsx');

        $COLUMN_AGENT = "Agent";
        $COLUMN_ALEA = "Aléa";
        $COLUMN_PREFECTURE = "Préfecture";
        $COLUMN_SOUSPREFECTURE = "Sous-préfecture";
        $COLUMN_LOCALITE = "Localité";
        $COLUMN_LATITUDE = "Latitude";
        $COLUMN_LONGITUDE = "Longitude";


        $compteur = 0;

        FastExcel::import($path, function ($data) use (
            $COLUMN_AGENT, $COLUMN_ALEA, $COLUMN_PREFECTURE, $COLUMN_SOUSPREFECTURE,
            $COLUMN_LOCALITE, $COLUMN_LATITUDE, $COLUMN_LONGITUDE, $compteur
        ) {

            if ($compteur == 1) {

                $this->errorColumn($COLUMN_AGENT, $data, $compteur);
                $this->errorColumn($COLUMN_ALEA, $data, $compteur);
                $this->errorColumn($COLUMN_PREFECTURE, $data, $compteur);
                $this->errorColumn($COLUMN_SOUSPREFECTURE, $data, $compteur);
                $this->errorColumn($COLUMN_LOCALITE, $data, $compteur);
                $this->errorColumn($COLUMN_LATITUDE, $data, $compteur);
                $this->errorColumn($COLUMN_LONGITUDE, $data, $compteur);

            }

            if(!count($this->error))
            {
                $agent = Agent::where("name", $data[$COLUMN_AGENT])->first();

                $alea = Alea::where('nom', $data[$COLUMN_ALEA])->first();

                if ($alea == null)
                {
                    $alea = new Alea();
                    $alea->nom = $data[$COLUMN_ALEA];
                    $alea->save();
                }

                $ville = Ville::where('nom', $data[$COLUMN_PREFECTURE])->first();

                if ($ville == null)
                {
                    $ville = new Ville();
                    $ville->nom = $data[$COLUMN_PREFECTURE];
                    $ville->save();
                }

                $sousPrefecture = SousPrefecture::where('nom', $data[$COLUMN_SOUSPREFECTURE])->first();

                if($sousPrefecture == null)
                {
                    $sousPrefecture = new SousPrefecture();
                    $sousPrefecture->nom = $data[$COLUMN_SOUSPREFECTURE];
                    $sousPrefecture->save();
                }

                $alerte = new Alerte();
                $alerte->agent_id = $agent->id;
                $alerte->alea_id = $alea->id;
                $alerte->ville_id = $ville->id;
                $alerte->sous_prefecture_id = $sousPrefecture->id;

                if (!empty($data[$COLUMN_LOCALITE]))
                    $alerte->localite = $data[$COLUMN_LOCALITE];

                if (!empty($data[$COLUMN_LATITUDE]))
                    $alerte->latitude = $data[$COLUMN_LATITUDE];

                if (!empty($data[$COLUMN_LONGITUDE]))
                    $alerte->longitude = $data[$COLUMN_LONGITUDE];


                $alerte->save();


            }
        });


        /* DB::table('alertes')->delete();


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
         }*/


    }

    public function errorColumn($column, $data, $ligne)
    {
        if (!isset($data[$column]))
            $this->error[] = "La colonne " . $column . " de la ligne " . $ligne . " n'exsite pas ou est mal écrite";
    }

    private function fakeGps($faker)
    {
        $lang = 9.509167;
        $long = -13.712222;


        $latitude = $faker->latitude($min = ($lang - (rand(0, 20) / 1000)), $max = ($lang + (rand(0, 20) / 1000)));
        $longitude = $faker->longitude($min = ($long - (rand(0, 20) / 1000)), $max = ($long + (rand(0, 20) / 1000)));

        return [$latitude, $longitude];
    }

    private function randDate()
    {
        $years = [2021, 2021];

        $annee = $years[rand(0, 1)];
        $mois = rand(1, 12);
        $jour = rand(1, 28);

        if ($annee == 2022) {
            $now = Carbon::now();

            $mois = rand(1, $now->month);
            $jour = rand(1, $now->day);
        }

        return Carbon::createFromDate($annee, rand(1, $mois), rand(1, $jour));
    }

}
