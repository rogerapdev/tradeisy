<?php

namespace App\Repositories;

use App\Models\Dividend;
use App\Repositories\BaseRepository;

/**
 * Class DividendRepository.
 *
 * @package namespace App\Repositories;
 */
class DividendRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Dividend::class;
    }

}
