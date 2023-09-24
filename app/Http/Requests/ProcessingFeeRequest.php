<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class ProcessingFeeRequest extends FormRequest
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
            'debit' => 'required|numeric',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => 'يرجى ادخال الطالب',
            'debit.required' => 'يرجى ادخال المبلغ ',
            'debit.numeric' => 'يرجى ادخال رقم',
            'description.required' => 'يرجى ادخال الوصف ',

        ];
    }
}
