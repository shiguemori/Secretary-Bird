<?php

use Illuminate\Database\Seeder;

class AdministradoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('administradores')->insert([
            [
                'nome' => 'Web Master',
                'sobrenome' => 'Developer',
                'email' => 'admin@admin.com.br',
                'password' => bcrypt('102030'),
                'status_id' => 1,
            ]
        ]);
    }
}
