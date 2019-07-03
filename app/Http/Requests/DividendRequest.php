<?php namespace App\Http\Requests;

use App\Http\Requests\CustomRequest;

class DividendRequest extends CustomRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'broker_id' => 'required',
            'stock_ticker' => 'required',
            'date' => 'required',
            'value' => 'required',
        ];
    }

}
