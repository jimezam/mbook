<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MsheetCreateRequest;
use App\Mbook;
use App\Msection;
use App\Msheet;

class MsheetCreateRequest extends FormRequest
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
            // 'msection_id' => 'required|exists:msections,id',
            'name'        => 'required|string|min:3|max:50',
            'contents'    => 'required|string',
            // 'order'       => 'required|integer',
            'foreground'  => 'regex:/^(#[a-zA-Z0-9]{6})$/i',
            'background'  => 'regex:/^(#[a-zA-Z0-9]{6})$/i'
        ];
    }
}
