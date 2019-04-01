<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 29 Nov 2018 03:30:46 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Status
 *
 * @property int $id
 * @property string $titulo
 *
 * @property \Illuminate\Database\Eloquent\Collection $categorias
 * @property \Illuminate\Database\Eloquent\Collection $paginas
 * @property \Illuminate\Database\Eloquent\Collection $produtos
 * @property \Illuminate\Database\Eloquent\Collection $sessos
 *
 * @package App\Models
 */
class Status extends Eloquent
{
    public const ATIVO = 1;
    public const INATIVO = 2;

    protected $fillable = [
        'titulo'
    ];

    protected $table = 'status';

    public function administradores()
    {
        return $this->hasMany(\App\Models\Administrador::class, 'status_id');
    }

    public function usuarios()
    {
        return $this->hasMany(\App\Models\Usuario::class, 'status_id');
    }
}
