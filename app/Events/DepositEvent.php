<?php

namespace App\Events;

use App\Models\Broker;
use App\Models\Deposit;

class DepositEvent
{

    /**
     * @param App\Models\Deposit
     */
    public function created($deposit)
    {

        $broker = Broker::findOrFail($deposit->broker_id);

        if ((float) $broker->invested <= 0) {
            $broker->invested = $deposit->value;
            $broker->available = $deposit->value;
        } else {
            $broker->available = ($broker->available + $deposit->value);
        }

        $broker->save();

        return true;
    }

    /**
     * @param App\Models\Deposit
     */
    public function updated($deposit)
    {

        $broker = Broker::findOrFail($deposit->broker_id);

        // // $amount = ($broker->available - $deposit->getOriginal('value')) + $deposit->value;
        // $broker->available = ($broker->available - $deposit->value);
        // // $broker->invested = ($broker->invested - $deposit->value);

        // $broker->save();

        return true;
    }

    /**
     * @param App\Models\Deposit
     */
    public function deleted($deposit)
    {

        $broker = Broker::findOrFail($deposit->broker_id);
        $broker->available = ($broker->available - $deposit->value);

        $broker->save();

        return true;
    }

    /**
     * @param $events
     */
    public function subscribe($events)
    {
        $events->listen('eloquent.created: ' . Deposit::class, 'App\Events\DepositEvent@created');
        $events->listen('eloquent.updated: ' . Deposit::class, 'App\Events\DepositEvent@updated');
        $events->listen('eloquent.deleted: ' . Deposit::class, 'App\Events\DepositEvent@deleted');

    }

}
