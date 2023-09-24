<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class QuizzeRequest extends FormRequest
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
            'teacher_id' => 'required',
            'subject_id' => 'required',
            'section_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.ar.required' => 'يرجى ادخال الاسم باعربي',
            'name.en.required' => 'يرجى ادخال الاسم بالانجليزي',
            'grade_id.required' => "يرجى ادخال المرحلة",
            'classroom_id.required' => 'يرجى ادخال الفصل',
            'teacher_id.required' => 'يرجى ادخال اسم الاستاذ',
            'subject_id.required' => 'يرجى ادخال اسم المادة',
            'section_id.required' => 'يرجى ادخال اسم الشعبة',
        ];
    }
}
