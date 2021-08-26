<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class contentRequest extends FormRequest
{
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
            'title' => 'required|unique:content,title,'.$this->get('id').'|max:100',
            'content' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'Content Title',
        ];
    }
}
