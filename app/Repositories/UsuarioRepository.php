<?php

namespace App\Repositories;

use App\Models\Usuario;

/**
 * Class UsuarioRepository
 * @package App\Repositories
 */
class UsuarioRepository extends BaseRepository
{
    /**
     * @var Usuario
     */
    public $model;

    /**
     * UsuarioRepository constructor.
     * @param Usuario $Usuario
     */
    public function __construct(Usuario $Usuario)
    {
        $this->model = $Usuario;
    }

}