<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'date' => ['required','after:today','before:'.Carbon::now()->addDay(7)->format('Y-m-d'),
                Rule::unique('slots','date')->where(function($query) use($id){
                    $query->where('provider_id',auth()->user()->id);
                })->ignore($id)
            ],
            'status' => 'required|between:1,2',
            'slot_duration' => 'required|numeric',
            'time_from' => 'required',
            'time_to' => 'required|after:time_from',
        ];
    }
}
