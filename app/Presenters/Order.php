<?php

namespace App\Presenters;

use App\Presenters\Presenter;

class Order extends Presenter
{

    /**
     * Shows formated date.
     *
     * @return string
     */
    public function date()
    {
        return formatDate($this->entity->date, 'd/m/Y');
    }

    /**
     * Shows formated unit_price.
     *
     * @return string
     */
    public function unit_price()
    {
        return formatMoney($this->entity->unit_price);
    }

    /**
     * Shows formated cost.
     *
     * @return string
     */
    public function cost()
    {
        return formatMoney($this->entity->cost);
    }

    /**
     * Shows formated expense.
     *
     * @return string
     */
    public function expense()
    {
        return formatMoney($this->entity->expense);
    }

    /**
     * Shows formated equilibrium_price.
     *
     * @return string
     */
    public function equilibrium_price()
    {
        return formatMoney($this->entity->equilibrium_price);
    }
}
