<?php

namespace App\Repositories;

use App\Models\Broker;
use App\Repositories\BaseRepository;

/**
 * Class BrokerRepository.
 *
 * @package namespace App\Repositories;
 */
class BrokerRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Broker::class;
    }

}
