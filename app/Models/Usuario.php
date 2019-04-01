<?php

/**
 * Created by Reliese Model.
 * Date: Thu, 29 Nov 2018 03:30:46 +0000.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MailResetPasswordToken;

/**
 * Class Usuario
 *
 * @property int $id
 * @property string $nome
 * @property string $sobrenome
 * @property string $email
 * @property string $senha
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class Usuario extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $guarded = 'web';

    protected $casts = [
        'status_id' => 'int',
    ];

    protected $fillable = [
        'nome',
        'sobrenome',
        'email',
        'password',
        'status_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $table = 'usuarios';

    /**
     * @param string $token
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordToken($token));
    }

    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class);
    }

    public function getFullName()
    {
        return "{$this->nome} {$this->sobrenome}";
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = (!empty($password) ? bcrypt($password) : $this->attributes['password']);
    }
}
