<?php

namespace App\Repositories;

use App\Models\Deposit;
use App\Repositories\BaseRepository;

/**
 * Class DepositRepository.
 *
 * @package namespace App\Repositories;
 */
class DepositRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Deposit::class;
    }

}
