<?php

namespace App\Traits;

use Auth;
use Illuminate\Database\Eloquent\Model;

trait TenantableTrait
{

    public static function bootTenantableTrait()
    {

        static::creating(function (Model $model) {
            if (empty($model->user_id)) {
                $model->user_id = Auth::user()->id;
            }
        });
    }

}
