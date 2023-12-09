<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        return [
            //
            'title' => 'required|max:50',
            'description' => 'required|max:250',

        ];
    }

    public function messages() {
        return [
            'title.required' => 'El título de la tarea es requerido',
            'title.max' => 'El título de la tarea debe tener máximo de 50 caracteres',
            'description.required' => 'La descripción de la tarea es requerida',
            'description.max' => 'La descripción de la tarea debe tener máximo de 250 caracteres',
        ];
    }
}
