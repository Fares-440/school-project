<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class TeacherRequest extends FormRequest
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
            'email' => "required|email|unique:teachers,email,$this->id,id",
            'password' => "required_without:id",
            'name.*' => "required|max:255",
            'specialization_id' => "required",
            'gender_id' => "required",
            'joining_date' => "required|date",
            'address' => "required",

        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'يرجى ادخال البريد الالكتروني',
            'email.unique' => 'البريد الالكتروني مستخدم',
            'password.required_without' => 'يرجى ادخال كلمة المرور',
            'name.ar.required' => 'يرجي ادخال اسم المدرس باللغة العربية',
            'name.en.required' => 'يرجي ادخال اسم المدرس باللغة الانجليزية',
            'specialization_id.required' => 'يرجى ادخال التخصص',
            'gender_id.required' => "يرجى ادخال الجنس",
            'joining_date.required' => "يرجى ادخال التاريخ",
            'joining_date.date' => "يرجى ادخال تاريخ صحيح",
            'address.required' => "يرجى ادخال العنوان",
        ];
    }
}
