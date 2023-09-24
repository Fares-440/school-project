<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class FeeRequest extends FormRequest
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
            'title.*' => 'required',
            'amount' => 'required|numeric',
            'grade_id' => 'required|integer',
            'classroom_id' => 'required|integer',
            'year' => 'required',
            'fee_type' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'title.ar.required' => trans('validation.required'),
            'title.en.required' => trans('validation.unique'),
            'amount.required' => trans('validation.required'),
            'amount.numeric' => trans('validation.numeric'),
            'grade_id.required' => trans('validation.required'),
            'classroom_id.required' => trans('validation.required'),
            'year.required' => trans('validation.required'),
            'fee_type.required' => trans('validation.required'),
        ];
    }
}
