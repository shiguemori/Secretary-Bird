<?php

namespace App\Repositories;

use App\Models\Administrador;

/**
 * Class AdministradorRepository
 * @package App\Repositories
 */
class AdministradorRepository extends BaseRepository
{
    /**
     * @var Administrador
     */
    public $model;
    
    /**
     * AdministradorRepository constructor.
     * @param Administrador $Administrador
     */
    public function __construct(Administrador $Administrador)
    {
        $this->model = $Administrador;
    }
}