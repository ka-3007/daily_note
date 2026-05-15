<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DeleteProfileRequest extends FormRequest
{
    // エラーメッセージのバッグ名（ビュー側で $errors->userDeletion として参照できる）
    protected $errorBag = 'userDeletion';

    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => ['required', 'current_password'],
        ];
    }

}
