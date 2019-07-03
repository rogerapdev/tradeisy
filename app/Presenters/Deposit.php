<?php

namespace App\Presenters;

use App\Presenters\Presenter;

class Deposit extends Presenter
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
     * Shows formated value.
     *
     * @return string
     */
    public function value()
    {
        return formatMoney($this->entity->value);
    }

}
