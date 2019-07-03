<?php

namespace App\Models;

use App\Traits\PresentableTrait;
use App\Traits\TenantableTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order.
 *
 * @package namespace App\Models;
 */
class Order extends Model
{
    use TenantableTrait, PresentableTrait;

    protected $presenter = 'App\Presenters\Order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'broker_id', 'stock_ticker', 'type', 'date', 'quantity', 'unit_price', 'cost', 'rate', 'expense', 'equilibrium_price', 'user_id',
    ];

    /**
     * Set the order's date.
     *
     * @param  string  $value
     * @return void
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = formatDate($value);
    }

    /**
     * Set the order's quantity.
     *
     * @param  string  $value
     * @return void
     */
    public function setQuantityAttribute($value)
    {
        $this->attributes['quantity'] = unFormatDecimal($value);
    }

    /**
     * Set the order's value.
     *
     * @param  string  $value
     * @return void
     */
    public function setUnitPriceAttribute($value)
    {
        $this->attributes['unit_price'] = unFormatMoney($value);
    }

    /**
     * A order always belongs to a broker.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function broker()
    {
        return $this->belongsTo('App\Models\Broker', 'broker_id', 'id');
    }
}
