<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class StudentRequest extends FormRequest
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
            'email' => "required|email|unique:students,email,$this->id,id",
            'name.*' => "required|max:255",
            'password' => "required_without:id",
            'gender_id' => "required",
            'nationalitie_id' => "required",
            'blood_id' => "required",
            'date_birth' => "required|date",
            'grade_id' => "required",
            'section_id' => "required",
            'classroom_id' => "required",
            'parent_id' => "required",
            'academic_year' => "required",
            'images.*' => 'nullable|image|mimes:jpeg,jpg,png|max:1000'
        ];
    }

    public function messages()
    {
        return [
            'name.ar.required' => 'يرجاء ادخال اسم الطالب',
            'name.en.required' => 'يرجاء ادخال اسم الطالب باللغة الانجليزية',
            'email.*.unique' => 'البريد الالكتروني موجود سابقاً',
            'password.required' => "يرجاء ادخال كلمة المرور",
            'gender_id.required' => "يرجاء ادخال الجنس",
            'nationalitie_id.required' => "يرجاء ادخال الجنسية",
            'blood_id.required' => "يرجاء ادخال فصيلة الدم",
            'date_birth.required' => "يرجاء ادخال تاريخ الميلاد",
            'grade_id.required' => "يرجاء ادخال المرحلة",
            'section_id.required' => "يرجاء ادخال الصف",
            'parent_id.required' => "يرجاء ادخال الاب او الام",
            'academic_year.required' => "يرجاء ادخال السنة الدراسية الحالية للطالب/ة",
            'classroom_id.required' => 'يرجاء ادخال الفصل',
        ];
    }
}
