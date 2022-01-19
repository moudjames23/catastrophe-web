<?php

use App\Models\Catastrophe;
use Illuminate\Database\Seeder;

class CatastropheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Catastrophe::class, 5)->create();
    }
}
