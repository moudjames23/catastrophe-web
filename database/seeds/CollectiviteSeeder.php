<?php

use App\Models\Region;
use App\Models\SousPrefecture;
use App\Models\Ville;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\Facades\FastExcel;

class CollectiviteSeeder extends Seeder
{
    private $error = array();
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sous_prefectures')->delete();
        DB::table('villes')->delete();
        DB::table('regions')->delete();

        $path = public_path('Collectivite.xlsx');

        $COLUMN_REGION = "Région";
        $COLUMN_VILLE = "Préfecture";
        $COLUMN_SOUSPREFECTURE = "Sous-préfecture";

        $compteur = 0;

        FastExcel::import($path, function ($data) use ($COLUMN_REGION,
        $COLUMN_VILLE, $COLUMN_SOUSPREFECTURE, $compteur){

            if ($compteur == 1) {

                $this->errorColumn($COLUMN_REGION, $data, $compteur);
                $this->errorColumn($COLUMN_VILLE, $data, $compteur);
                $this->errorColumn($COLUMN_SOUSPREFECTURE, $data, $compteur);

            }

            if(!count($this->error))
            {
                if ($data != null)
                {
                    $region = Region::whereNom($data[$COLUMN_REGION])->first();

                    if($region == null)
                    {
                        $region = new Region();
                        $region->nom = $data[$COLUMN_REGION];
                        $region->save();
                    }

                    $ville = Ville::whereNom($data[$COLUMN_VILLE])->first();

                    if ($ville == null)
                    {
                        $ville = new Ville();
                        $ville->nom = $data[$COLUMN_VILLE];
                        $ville->region_id = $region->id;
                        $ville->save();
                    }

                    $sousPrefecture = SousPrefecture::whereNom($data[$COLUMN_SOUSPREFECTURE])
                        ->first();

                    if ($sousPrefecture == null)
                    {
                        $sousPrefecture = new SousPrefecture();
                        $sousPrefecture->nom = $data[$COLUMN_SOUSPREFECTURE];
                        $sousPrefecture->ville_id = $ville->id;
                        $sousPrefecture->save();
                    }
                }
            }


        });

    }

    public function errorColumn($column, $data, $ligne)
    {
        if (!isset($data[$column]))
            $this->error[] = "La colonne " . $column . " de la ligne " .$ligne. " n'exsite pas ou est mal écrite";
    }
}
