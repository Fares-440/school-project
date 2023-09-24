<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class PromotionRequest extends FormRequest
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
            'student_id' => 'required',
            'grade_id' => 'required',
            'classroom_id' => 'required',
            'section_id' => 'required',
            'grade_id_new' => 'required',
            'classroom_id_new' => 'required',
            'section_id_new' => 'required',
            'academic_year' => 'required',
            'academic_year_new' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => 'يرجى ادخال الطالب',
            'grade_id.required' => 'يرجى ادخال المرحلة القديمة',
            'classroom_id.required' => 'يرجى ادخال الفصل القديم',
            'section_id.required' => 'يرجى ادخال القسم القديم',
            'academic_year.required' => 'يرجى ادخال السنه القديمة',
            'grade_id_new.required' => 'يرجى ادخال المرحلة الجديدة',
            'classroom_id_new.required' => 'يرجى ادخال الفصل الجديد',
            'section_id_new.required' => 'يرجى ادخال القسم الجديد',
            'academic_year_new.required' => 'يرجى ادخال السنه الجديدة',
        ];
    }
}
