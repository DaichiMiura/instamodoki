<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePost extends FormRequest
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
            'image'   => 'required|mimes:jpeg,jpg,png,gif|max:61440',
            'caption' => 'max:200',
        ];
    }

    public function attributes()
    {
        return [
            'image'   => '画像ファイル',
            'caption' => 'キャプション',
        ];
    }
}
