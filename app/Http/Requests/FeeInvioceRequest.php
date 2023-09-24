<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class FeeInvioceRequest extends FormRequest
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
            'list_fees.*.student_id' => 'required|integer',
            'list_fees.*.fee_id' => 'required|integer',
            'list_fees.*.amount' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'list_fees.*.student_id.required' => 'يرجى اختيار اسم الطالب',
            'list_fees.*.fee_id.required' => 'يرجى اختيار نوع الرسوم',
            'list_fees.*.student_id.integer' => 'يرجى ادخال رقم الطالب',
            'list_fees.*.fee_id.integer' => 'يرجى ادخال رقم نوع الرسوم',
            'list_fees.*.amount.required' => 'يرجى ادخال المبلغ',
            'list_fees.*.amount.numeric' => 'يرجى ادخال رقم صحيح او رقم عشري',
        ];
    }
}
