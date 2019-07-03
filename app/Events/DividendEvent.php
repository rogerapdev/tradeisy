<?php

namespace App\Events;

use App\Models\Broker;
use App\Models\Dividend;

class DividendEvent
{

    /**
     * @param App\Models\Dividend
     */
    public function created($dividend)
    {

        $broker = Broker::findOrFail($dividend->broker_id);

        $broker->available = (floatval($broker->available) + $dividend->value);
        // dd($broker->available);

        $broker->save();

        return true;
    }

    /**
     * @param $events
     */
    public function subscribe($events)
    {
        $events->listen('eloquent.created: ' . Dividend::class, 'App\Events\DividendEvent@created');

    }

}
