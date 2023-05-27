<?php

namespace App\Http\Controllers\Generate;

use App\Http\JsonRequest;

class GenerateNewEntityRequest extends JsonRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'root_directory' => ['required', 'string'],
            'entity_name' => ['required', 'string'],
            'fields' => [],
        ];
    }
}
