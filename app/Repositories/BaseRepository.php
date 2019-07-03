<?php

namespace App\Repositories;

use App\Criteria\TenantCriteria;
use Prettus\Repository\Eloquent\BaseRepository as EloquentRepository;

/**
 * Class BaseRepository.
 *
 * @package namespace App\Repositories;
 */
class BaseRepository extends EloquentRepository
{

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(TenantCriteria::class);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return "";
    }

}
