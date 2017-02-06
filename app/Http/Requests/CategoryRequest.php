<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'parent_id' => 'required|integer',
            'title' => 'required|min:3|max:255',
            'nav_title' => 'required|min:3|max:255',
            'standard' => 'max:255',
            'additionally' => 'max:255',
            'description' => 'required',
            'text' => 'required',
        ];
    }
}
