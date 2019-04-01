<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 29 Dec 2018 18:28:46 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class AdministradorGrupo
 * 
 * @property int $id
 * @property int $administrador_id
 * @property int $grupo_id
 * 
 * @property \App\Models\Administrador $administrador
 * @property \App\Models\Grupo $grupo
 *
 * @package App\Models
 */
class AdministradorGrupo extends Eloquent
{
	public $timestamps = false;

	protected $casts = [
		'administrador_id' => 'int',
		'grupo_id' => 'int'
	];

	protected $fillable = [
		'administrador_id',
		'grupo_id'
	];

	protected $table = 'administradores_grupos';

	public function administrador()
	{
		return $this->belongsTo(\App\Models\Administrador::class, 'administrador_id');
	}

	public function grupo()
	{
		return $this->belongsTo(\App\Models\Grupo::class, 'grupo_id');
	}
}
