<?php

namespace App\Models;

use App\Traits\PresentableTrait;
use App\Traits\TenantableTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Dividend.
 *
 * @package namespace App\Models;
 */
class Dividend extends Model
{
    use TenantableTrait, PresentableTrait;

    protected $presenter = 'App\Presenters\Dividend';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'broker_id', 'stock_ticker', 'description', 'date', 'value', 'user_id',
    ];

    /**
     * Set the dividend's date.
     *
     * @param  string  $value
     * @return void
     */
    public function setDateAttribute($value)
    {
        $this->attributes['date'] = formatDate($value);
    }

    /**
     * Set the dividend's value.
     *
     * @param  string  $value
     * @return void
     */
    public function setValueAttribute($value)
    {
        $this->attributes['value'] = unFormatMoney($value);
    }

    /**
     * A dividend always belongs to a broker.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function broker()
    {
        return $this->belongsTo('App\Models\Broker', 'broker_id', 'id');
    }
}
