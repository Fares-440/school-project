<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Redirect;

class QuestionRequest extends FormRequest
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
            'title' => 'required|max:255',
            'answers' => 'required|max:255',
            'right_answer' => 'required|max:255',
            'score' => 'required',
            'quizze_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'يرجى اختيار اسم الطالب',
            'answers.required' => 'يرجى اختيار نوع الرسوم',
            'right_answer.required' => 'يرجى ادخال رقم الطالب',
            'score.required' => 'يرجى ادخال المبلغ',
            'quizze_id.required' => 'يرجى ادخال المبلغ',
        ];
    }
}
