<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\User::class, 10)->create();
        $user = [
            'email' => 'test@test.com',
            'name' => 'test',
            'password' => bcrypt('es'),
        ];



        DB::table('users')->insert([$user]);
    }
}
