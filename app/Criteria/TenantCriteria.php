<?php

namespace App\Criteria;

use Auth;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class TenantCriteria.
 *
 * @package namespace App\Criteria;
 */
class TenantCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('user_id', Auth::user()->id);

        return $model;
    }
}
