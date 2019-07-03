<?php

namespace App\Presenters;

use App\Presenters\Presenter;

class Stock extends Presenter
{

    /**
     * Shows formated average_price.
     *
     * @return string
     */
    public function average_price()
    {
        return formatMoney($this->entity->average_price);
    }

    /**
     * Shows formated invested.
     *
     * @return string
     */
    public function invested()
    {
        return formatMoney($this->entity->invested);
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

    /**
     * Shows formated quote.
     *
     * @return string
     */
    public function quote()
    {
        return formatMoney($this->entity->quote);
    }

    /**
     * Shows formated yield.
     *
     * @return string
     */
    function yield () {
        return formatMoney($this->entity->yield);
    }

    /**
     * Shows formated current_cost.
     *
     * @return string
     */
    public function current_cost()
    {
        return formatMoney($this->entity->current_cost);
    }

    /**
     * Shows formated gain.
     *
     * @return string
     */
    public function gain()
    {
        return formatDecimal($this->entity->gain);
    }
}
