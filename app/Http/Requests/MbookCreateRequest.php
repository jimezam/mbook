<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MbookCreateRequest extends FormRequest
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
            // 'user_id'     => 'required|exists:user,id',
            'category_id' => 'required|exists:categories,id',
            'shortname'   => 'required|alpha_dash|min:5|max:13',
            'name'        => 'required|string|min:5|max:100',
            'description' => 'nullable',
            // 'state'       => 'required|in:["private", "published", "inactive"]',
            'state'       => 'required|in:'.implode(",", \App\Mbook::getStates()),
        ];
    }
}
