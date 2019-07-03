<?php

namespace App\Models;

use App\Traits\PresentableTrait;
use App\Traits\TenantableTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Broker.
 *
 * @package namespace App\Models;
 */
class Broker extends Model
{
    use TenantableTrait, PresentableTrait;

    protected $presenter = 'App\Presenters\Broker';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'brokerage', 'emolument_normal', 'emolument_daytrade', 'percentage_stop_loss', 'percentage_stop_gain', ' user_id',
    ];

    /**
     * Set the broker's brokerage.
     *
     * @param  string  $value
     * @return void
     */
    public function setBrokerageAttribute($value)
    {
        $this->attributes['brokerage'] = unFormatMoney($value);
    }

    /**
     * Set the broker's emolument normal.
     *
     * @param  string  $value
     * @return void
     */
    public function setEmolumentNormalAttribute($value)
    {
        $this->attributes['emolument_normal'] = unFormatMoney($value);
    }

    /**
     * Set the broker's emolument daytrade.
     *
     * @param  string  $value
     * @return void
     */
    public function setEmolumentDaytradeAttribute($value)
    {
        $this->attributes['emolument_daytrade'] = unFormatMoney($value);
    }

    /**
     * Set the broker's percentage stop loss.
     *
     * @param  string  $value
     * @return void
     */
    public function setPercentageStopLossAttribute($value)
    {
        $this->attributes['percentage_stop_loss'] = unFormatMoney($value);
    }

    /**
     * Set the broker's percentage stop gain.
     *
     * @param  string  $value
     * @return void
     */
    public function setPercentageStopGainAttribute($value)
    {
        $this->attributes['percentage_stop_gain'] = unFormatMoney($value);
    }

    /**
     * Get the orders for the broker.
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}

// formatMoney($money, $decimal_places = 2, $force_places = false, $prefix = 'R$ ')
