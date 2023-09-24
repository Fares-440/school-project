<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class ClassroomRequest extends FormRequest
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
            'name_ar' => "required|max:255",
            'name_en' => "required|max:255",
            'grade_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name_ar.required' => trans('My_Classes_trans.required_ar'),
            'name_en.required' => trans('My_Classes_trans.required_en'),
            'grade_id.required' => "يجب ادخال المرحلة",
        ];
    }
}
