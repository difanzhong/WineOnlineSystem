<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWineRequest extends FormRequest
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
            'name' => 'required',
            'brand' => 'required',
            'year' => 'required|numeric',
            'grape' => 'required',
            'size' => 'required',
            'price' => 'required|numeric|min:0|not_in:0',
            'stock_price' => 'required|numeric|min:0|not_in:0',
            'cap' => 'required',
            'stock' => 'required|numeric',
            'rewarded' => 'boolean',
            'description' => 'max:200'
        ];
    }
}
