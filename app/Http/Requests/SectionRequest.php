<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class SectionRequest extends FormRequest
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
            'name.*' => "required|max:255|unique:sections,name,$this->id,id",
            'grade_id' => "required",
            'classroom_id' => "required",
            'status' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.ar.required' => trans('Sections_trans.required_ar'),
            'name.en.required' => trans('Sections_trans.required_en'),
            'name.*.unique' => trans('Grades_trans.exists'),
            'grade_id.required' => "يرجى ادخال المرحلة",
            'classroom_id.required' => 'يرجى ادخال الفصل',
        ];
    }
}
