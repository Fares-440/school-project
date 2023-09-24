<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class SubjectRequest extends FormRequest
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
            'name.*' => "required|max:255",
            'grade_id' => "required",
            'classroom_id' => "required",
            'teacher_id' => "required",

        ];
    }

    public function messages()
    {
        return [

            'name.ar.required' => 'يرجي ادخال اسم الماده باللغة العربية',
            'name.en.required' => 'يرجي ادخال اسم الماده باللغة الانجليزية',
            'grade_id.required' => 'يرجى ادخال المرحلة الدراسية',
            'classroom_id.required' => "يرجى ادخال الفصل الدراسي",
            'teacher_id.required' => "يرجى ادخال اسم الاستاذ/ة",
        ];
    }
}
