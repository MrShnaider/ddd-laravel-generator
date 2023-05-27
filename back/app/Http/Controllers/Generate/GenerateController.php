<?php

namespace App\Http\Controllers\Generate;

use App\Domain\CleanArchFacade\CleanArchFacade;
use App\Domain\CleanArchFacade\Directories;
use App\Domain\FileGenerator\ExceptionFileAlreadyExists;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class GenerateController extends Controller
{
    public function generateNewEntity(GenerateNewEntityRequest $request): JsonResponse
    {
        $data = $request->validated();
        $directory = $data['root_directory'];
        $fields = $data['fields'] ?? [];
        Directories::$basePath = $directory;
        try {
            app(CleanArchFacade::class)->generateNewEntity($data['entity_name'], $fields);
        } catch (ExceptionFileAlreadyExists $e) {
            response()->json(['errors' => ['error' => 'Некоторые директории уже существовали']], 201);
        }
        return response()->json(['name' => $data['entity_name']], 201);
    }
}
