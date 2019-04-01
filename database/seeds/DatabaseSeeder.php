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
         $this->call(StatusTableSeeder::class);
         $this->call(PermissoesTableSeeder::class);
         $this->call(AdministradoresTableSeeder::class);
         $this->call(GruposTableSeeder::class);
         $this->call(AdministradoresPermissoesTableSeeder::class);
    }
}
