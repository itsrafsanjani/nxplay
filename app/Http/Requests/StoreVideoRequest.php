<?php

namespace App\Http\Requests;

use App\Rules\VideoRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tmdb_id' => ['required', 'integer', 'unique:videos'],
            'video' => ['required', new VideoRule()], // uploaded video path
            'status' => 'required',
        ];
    }
}
