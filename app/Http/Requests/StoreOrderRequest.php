<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Wine;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'paid' => 'boolean',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'wine_id' => 'required',
            'box' => 'required|boolean',
            'client_id' => 'required',
            'profit' => '',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->wine_id != null || $this->wine_id != 0) {
            $wine = Wine::findOrFail($this->wine_id);
            $this->merge([
                'profit' => ($this->price - $wine->stock_price)
            ]);
        }
    }
}
