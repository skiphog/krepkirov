<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $this->request->set('user_id', $user->id);
            $this->request->set('name', $user->name);
            $this->request->set('email', $user->email);
            $this->request->set('organization', $user->organization);
            $this->request->set('phone', $user->phone);
        }

        /*$this->request->set('positions', count($this->session()->get('cart')));
        $this->request->set('sum', $this->session()->get('total'));
        $this->request->set('weight', $this->session()->get('weight'));*/
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'   => 'required|max:255',
            'phone'  => 'required|max:50',
            'note'   => 'max:255',
            'email'  => 'sometimes|email',
            'policy' => 'accepted'
        ];
    }
}
