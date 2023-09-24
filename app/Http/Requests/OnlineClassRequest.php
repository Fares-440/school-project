<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class OnlineClassRequest extends FormRequest
{
    public function response(array $errors)
    {
        return Redirect::back()->withErrors($errors)->withInput();
    }
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
            'grade_id' => 'required',
            'classroom_id' => 'required',
            'section_id' => 'required',
            'topic' => 'required',
            'start_time' => 'required',
            'duration' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'grade_id.required' => trans('validation.required'),
            'classroom_id.required' => trans('validation.required'),
            'section_id.required' => trans('validation.unique'),
            'topic.required' => trans('validation.required'),
            'start_time.required' => trans('validation.required'),
            'duration.required' => trans('validation.required'),
        ];
    }
}
