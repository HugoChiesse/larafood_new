<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->segment(3);

        $roles =  [
            'name' => ['required', 'string', 'min:3', 'max:191', "unique:users,name,{$id},id"],
            'email' => ['required', 'string', 'email', "unique:users,email,{$id},id"],
            'password' => ['required', 'string', 'min:8', 'max:16']
        ];

        if ($this->method('put')) {
            $roles['password'] =  ['nullable', 'string', 'min:8', 'max:16'];
        }
        return $roles;
    }
}
