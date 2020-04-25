<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'alias' => 'required | unique:services,alias,'.$this->route('id'),
            'name' => 'required|unique:services,name,'.$this->route('id'),
            'service_id' => 'required|exists:services,id',
            'image' => 'mimes:jpeg,png,gif,jpg,webp',
            'icon' => 'mimes:jpeg,png,gif,jpg,webp,ico',
        ];
    }
}
