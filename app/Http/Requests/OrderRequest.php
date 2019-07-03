<?php namespace App\Http\Requests;

use App\Http\Requests\CustomRequest;

class OrderRequest extends CustomRequest
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
            'type' => 'required',
            'date' => 'required',
            'quantity' => 'required',
            'unit_price' => 'required',
        ];
    }

}
