<?php

use Illuminate\Database\Seeder;

class AdministradoresPermissoesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('administradores_permissoes')->delete();

        $super_admin = [];

        for ($i = 1; $i <= 29; $i++) {
            $super_admin[$i] = ['administrador_id' => 1, 'permissao_id' => $i];
        }

        \DB::table('administradores_permissoes')->insert($super_admin);
    }
}
