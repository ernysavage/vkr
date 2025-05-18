<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // разрешаем авторизованным
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'in:income,expense'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'category' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
        ];
    }
}
