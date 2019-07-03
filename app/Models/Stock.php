<?php

namespace App\Models;

use App\Traits\PresentableTrait;
use App\Traits\TenantableTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Stock.
 *
 * @package namespace App\Models;
 */
class Stock extends Model
{
    use TenantableTrait, PresentableTrait;

    protected $presenter = 'App\Presenters\Stock';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'broker_id', 'stock_ticker', 'quantity', 'average_price', 'invested', 'stop_loss', 'stop_gain', 'rate', 'expense', 'equilibrium_price', 'user_id',
    ];

    /**
     * Set the stock's quantity.
     *
     * @param  string  $value
     * @return void
     */
    public function setQuantityAttribute($value)
    {
        $this->attributes['quantity'] = unFormatDecimal($value);
    }

    /**
     * Set the stock's value.
     *
     * @param  string  $value
     * @return void
     */
    public function setAveragePriceAttribute($value)
    {
        $this->attributes['average_price'] = unFormatMoney($value);
    }

    /**
     * A stock always belongs to a broker.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function broker()
    {
        return $this->belongsTo('App\Models\Broker', 'broker_id', 'id');
    }
}
