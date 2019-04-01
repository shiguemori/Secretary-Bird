<?php

/**
 * Created by Reliese Model.
 * Date: Mon, 14 Jan 2019 15:17:23 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class Permissao
 *
 * @property int $id
 * @property string $label
 * @property string $rota
 * @property int $permissao_id
 * @property string $icone
 * @property int $visivel_menu
 * @property int $visivel_user
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $users
 *
 * @package App\Models
 */
class Permissao extends Eloquent
{
    protected $table = 'permissoes';

    protected $casts = [
        'permissao_id' => 'int',
        'visivel_menu' => 'int',
        'visivel_user' => 'int',
        'mobile' => 'int',
    ];

    protected $fillable = [
        'label',
        'controller',
        'rota',
        'permissao_id',
        'icone',
        'visivel_menu',
        'visivel_user',
        'mobile'
    ];

    public function administrador()
    {
        return $this->belongsToMany(\App\Models\Administrador::class, 'administradores_permissoes', 'permissao_id')
            ->withPivot('id')
            ->withTimestamps();
    }

    public function permissoes()
    {
        return $this->hasMany(Permissao::class, 'permissao_id');
    }

        public function permissao()
    {
        return $this->belongsTo(Permissao::class, 'id');
    }
}
