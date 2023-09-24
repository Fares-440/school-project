<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class AttendanceRequest extends FormRequest
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
            'student_id.*' => "required",
            'grade_id' => 'required',
            'classroom_id' => 'required',
            'section_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'student_id.*.required' => 'يرجى ادخال الطالب',
            'classroom_id.required' => 'يرجى ادخال الفصل',
            'section_id.required' => 'يرجى ادخال القسم',
            'grade_id.required' => "يجب ادخال المرحلة",
        ];
    }
}
