<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class GradeRequest extends FormRequest
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
            'name.*' => "required|max:255|unique:grades,name,$this->id,id",
            'notes' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.ar.required' => trans('Grades_trans.required_ar'),
            'name.en.required' => trans('Grades_trans.required_en'),
            'name.*.unique' => trans('Grades_trans.exists'),
        ];
    }
}
