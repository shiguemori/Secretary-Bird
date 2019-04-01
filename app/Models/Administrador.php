<?php

/**
 * Created by Reliese Model.
 * Date: Sat, 29 Dec 2018 18:01:52 +0000.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Jenssegers\Agent\Facades\Agent;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminMailResetPasswordToken;

/**
 * Class Administrador
 *
 * @property int $id
 * @property string $nome
 * @property string $sobrenome
 * @property string $password
 * @property string $email
 * @property int $status_id
 * @property string $remember_token
 * @property string $deleted_at
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @property \Illuminate\Database\Eloquent\Collection $grupos
 *
 * @package App\Models
 */
class Administrador extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $guarded = 'admin';

    protected $casts = [
        'status_id' => 'int'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $fillable = [
        'nome',
        'sobrenome',
        'password',
        'email',
        'status_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $table = 'administradores';

    /**
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminMailResetPasswordToken($token));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function grupos()
    {
        return $this->belongsToMany(\App\Models\Grupo::class, 'administradores_grupos', 'administrador_id', 'grupo_id');
    }

    public function getFullName()
    {
        return "{$this->nome} {$this->sobrenome}";
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = (!empty($password) ? bcrypt($password) : $this->attributes['password']);
    }

    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class);
    }

    public function administradores_permissoes()
    {
        return $this->belongsToMany(\App\Models\Permissao::class, 'administradores_permissoes', 'administrador_id', 'permissao_id');
    }

    /**
     * Valida permissões do usuário logado
     * Verificando em qual dispositivo ele está e dando as devidas permissões para tais
     * @param $rota_name
     * @return bool
     */
    public function hasPermissao($rota_name)
    {
        if (Agent::isMobile() || Agent::isTablet()) {
            foreach ($this->administradores_permissoes()->where('mobile', 1)->get() as $permissao) {
                if ($permissao->rota === $rota_name) {
                    return true;
                }
            }
            return false;
        }
        foreach ($this->administradores_permissoes()->get() as $permissao) {
            if ($permissao->rota === $rota_name) {
                return true;
            }
        }
        return false;
    }

}
