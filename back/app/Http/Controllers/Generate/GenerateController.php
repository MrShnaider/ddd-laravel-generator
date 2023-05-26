<?php

namespace App\Http\Controllers\Generate;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class GenerateController extends Controller
{
    public function generateNewEntity(GenerateNewEntityRequest $request): JsonResponse
    {
        $data = $request->validated();
        return response()->json(['name' => $data['entity_name']], 201);
    }
}
