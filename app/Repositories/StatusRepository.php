<?php

namespace App\Repositories;

use App\Models\Status;

/**
 * Class StatusRepository
 * @package App\Repositories
 */
class StatusRepository extends BaseRepository
{
    /**
     * @var Status
     */
    public $model;
    
    /**
     * StatusRepository constructor.
     * @param Status $Status
     */
    public function __construct(Status $Status)
    {
        $this->model = $Status;
    }
}