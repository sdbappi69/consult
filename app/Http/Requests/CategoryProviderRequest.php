<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryProviderRequest extends FormRequest
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
            'category_id' => ['required',
                Rule::unique('category_provider','category_id')->where(function($q){
                    $q->where('provider_id',auth()->user()->id);
                })->ignore($this->route('id'))
            ],
            'min_per_slot' => 'required|numeric',
            'fee_per_slot' => 'required|numeric',
            'service_charge_per_slot' => 'nullable|numeric'
        ];
    }
}
