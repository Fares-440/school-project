<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class LibraryRequest extends FormRequest
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
            'title' => 'required',
            'grade_id' => 'required',
            'classroom_id' => 'required',
            'section_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => trans('validation.required'),
            'grade_id.required' => trans('validation.required'),
            'classroom_id.required' => trans('validation.required'),
            'section_id.required' => trans('validation.unique'),
        ];
    }
}
