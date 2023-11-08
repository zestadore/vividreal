<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Http\FormRequest;

class ValidateCompany extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('company')??Crypt::encrypt(0);
        $id=Crypt::decrypt($id);
        return [
            'company_name' => 'required',
            'email' => 'required|unique:companies,email,'. $id,
            'logo'=>'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
}
