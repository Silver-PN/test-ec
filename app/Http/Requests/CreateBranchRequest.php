<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBranchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'Branch_Code' => 'required|unique:branches,Branch_Code',
            'Branch_Name' => 'required',
            'Branch_Province' => 'required',
            'Branch_District' => 'required',
            'Branch_Ward' => 'required',
            'Branch_Street' => 'required',
            'Branch_Phone' => 'required',
        ];
    }


}