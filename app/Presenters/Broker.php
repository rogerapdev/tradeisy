<?php

namespace App\Presenters;

use App\Presenters\Presenter;

class Broker extends Presenter
{

    /**
     * Shows formated brokerage.
     *
     * @return string
     */
    public function brokerage()
    {
        return formatMoney($this->entity->brokerage);
    }

    /**
     * Shows formated emolument_normal.
     *
     * @return string
     */
    public function emolument_normal()
    {
        return formatDecimal($this->entity->emolument_normal, 4);
    }

    /**
     * Shows formated emolument_normal.
     *
     * @return string
     */
    public function emolument_daytrade()
    {
        return formatDecimal($this->entity->emolument_daytrade, 4);
    }

    /**
     * Shows formated percentage_stop_loss.
     *
     * @return string
     */
    public function percentage_stop_loss()
    {
        return formatDecimal($this->entity->percentage_stop_loss);
    }

    /**
     * Shows formated percentage_stop_gain.
     *
     * @return string
     */
    public function percentage_stop_gain()
    {
        return formatDecimal($this->entity->percentage_stop_gain);
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
     * Shows formated available.
     *
     * @return string
     */
    public function available()
    {
        return formatMoney($this->entity->available);
    }
}
