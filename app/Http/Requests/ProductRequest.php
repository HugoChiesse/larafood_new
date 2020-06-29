<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

        $roles = [
            'title' => ['required', 'min:3', 'max:40', 'string', "unique:products,title,{$id},id"],
            'description' => ['required', 'min:3', 'max:10000', 'string'],
            'price' => "required|regex:/^\d+(\.\d{1,2})?$/",
            'image' => ['required', 'image']
        ];

        if ($this->method('put')) {
            $roles['image'] = ['nullable', 'image'];
        }

        return $roles;
    }
}
