<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if($this->isMethod('post')) {
            return Auth::check();
        }

        if($this->isMethod('put') || $this->isMethod('patch')) {
            return Auth::check() && $this->contact->user_id == Auth::id();
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = Auth::id();
        
        $rules = [
            'name' => ['required', 'alpha', 'max:255'],
            'country_code' => ['required', 'numeric', 'min:1', 'max:9999'],
        ];

        if ($this->isMethod('post')) {
            $rules['phone_no'] = [
                'required',
                'numeric',
                Rule::unique('contacts', 'phone_no')->where('user_id', $userId)
            ];
        } 
        
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['phone_no'] = [
                'required',
                'numeric',
                Rule::unique('contacts', 'phone_no')->where('user_id', $userId)->ignore($this->contact)
            ];
        }

        return $rules;
    }
}
