<?php

use Illuminate\Database\Seeder;

class MapTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
//        DB::table('maps')->insert([
//          'name' => ''
//        ]);
        factory(App\Map::class, 10)->create();
    }
}
