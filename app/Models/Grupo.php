<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 29 Nov 2018 03:30:46 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Grupo
 *
 * @property int $id
 * @property string $titulo
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $administradores
 *
 * @package App\Models
 */
class Grupo extends Eloquent
{
    use SoftDeletes;

    const WEBMASTER = 1;

    protected $fillable = [
        'titulo'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function administradores()
    {
        return $this->belongsToMany(\App\Models\Administrador::class, 'administradores_grupos', 'grupo_id', 'administrador_id');
    }

}
