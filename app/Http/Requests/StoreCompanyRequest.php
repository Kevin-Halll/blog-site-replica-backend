<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            "name" => "required|string",
            "description" => "required|string",
            "email" => "required|string",
            "phone" => "required|string",
            "website" => "string|url",
            "menu_url" => "string|url",
            "category_ids" => "string",
            "amenities" => "string",
            "tags" => "string",
        ];
    }
}
