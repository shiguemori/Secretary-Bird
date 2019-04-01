<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 14 Jan 2019 15:16:35 +0000.
 */

namespace App;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class UserRotaPermissao
 * 
 * @property int $administrador_id
 * @property int $permissao_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\Permissao $permissao
 * @property \App\Models\Administrador $administrador
 *
 * @package App\Models
 */
class AdministradorPermissao extends Eloquent
{

	protected $casts = [
		'administrador_id' => 'int',
		'permissao_id' => 'int'
	];

	protected $fillable = [
		'administrador_id',
		'permissao_id'
	];

	protected $table = 'administradores_permissoes';

	public function permissao()
	{
		return $this->belongsTo(\App\Models\Permissao::class, 'permissao_id');
	}

	public function administrador()
	{
		return $this->belongsTo(\App\Models\Administrador::class, 'administrador_id');
	}
}
