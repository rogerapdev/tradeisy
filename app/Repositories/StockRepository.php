<?php

namespace App\Repositories;

use App\Models\Stock;
use App\Repositories\BaseRepository;

/**
 * Class StockRepository.
 *
 * @package namespace App\Repositories;
 */
class StockRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Stock::class;
    }

}
