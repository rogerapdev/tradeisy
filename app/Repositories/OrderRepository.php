<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\BaseRepository;

/**
 * Class OrderRepository.
 *
 * @package namespace App\Repositories;
 */
class OrderRepository extends BaseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    // public function buyOrder()
    // {

    //     $broker = Broker::findOrFail($this->model->broker_id);

    //     $quantity = unFormatDecimal($this->model->quantity);
    //     $this->model->cost = $quantity * unFormatMoney($this->model->unit_price);
    //     $this->model->rate = percentage($broker->emolument_normal, $this->model->cost);
    //     $this->model->expense = $broker->brokerage + $this->model->rate;
    //     $this->model->equilibrium_price = ceiling(($this->model->cost + $this->model->expense) / $quantity, 0.01);

    // }

    // public function sellOrder()
    // {

    // }

}
