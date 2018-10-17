<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    //    factory(App\Anggota::class,1000)->create();
       factory(App\Anggota::class,100)->create();
    }
}
