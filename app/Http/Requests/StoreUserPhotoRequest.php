<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserPhotoRequest extends FormRequest
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
            // 'file'  => 'required|mimes:png,jpg,jpeg,gif|max:2305',
            'user_id' => ['required', 'integer'],
            'caption' => ['string', 'max:255'],
        ];
    }
}
