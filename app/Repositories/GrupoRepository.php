<?php

namespace App\Repositories;

use App\Models\Grupo;

/**
 * Class GrupoRepository
 * @package App\Repositories
 */
class GrupoRepository extends BaseRepository
{
    /**
     * @var Grupo
     */
    public $model;
    
    /**
     * GrupoRepository constructor.
     * @param Grupo $Grupo
     */
    public function __construct(Grupo $Grupo)
    {
        $this->model = $Grupo;
    }
}