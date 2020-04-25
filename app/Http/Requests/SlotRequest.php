<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class SlotRequest extends FormRequest
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
            'category_provider_id' => ['required',
                    Rule::exists('category_provider','id')->where(function ($q){
                        $q->where('provider_id',auth()->user()->id);
                    })
                ],
            'date' => ['required','after:today','before:'.Carbon::now()->addDay(7)->format('Y-m-d'),
                Rule::unique('slots','date')->where(function($query){
                    $query->where('category_provider_id',auth()->user()->id);
                })->ignore($this->route('id'))
            ],
            'status' => 'required|between:1,2',
            'slot_duration' => 'required|numeric',
            'time_from' => 'required',
            'time_to' => 'required|after:time_from',
        ];
    }
}
