<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\PetsModel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PetsTableSeeder::class);
    }
}

class PetsTableSeeder extends Seeder {

    public function run()
    {
        //DB::table('pets')->delete();

        PetsModel::create([
            'id_user' => 1,
            'pet_type' => 'dog'
        ]);
    }

}
