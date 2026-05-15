<?php

namespace App\Http\Requests;

use App\Models\Diary;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDiaryRequest extends FormRequest
{
    public function authorize(): bool
    {
        $diary = $this->route('diary');

        return $diary instanceof Diary
            && auth()->check()
            && auth()->id() === $diary->user_id;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:500'],
            'image'   => ['nullable', 'image', 'mimes:jpg,jpeg', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'image.max' => '画像は5MB以下のファイルを選択してください。',
        ];
    }
}
