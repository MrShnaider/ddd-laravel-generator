<?php

namespace App\Http\Controllers\Generate;

use App\Domain\CleanArchFacade\CleanArchFacade;
use App\Domain\CleanArchFacade\Directories;
use App\Domain\FileGenerator\ExceptionFileAlreadyExists;
use App\Domain\Renderer\FieldValue;
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
//        return response()->json(['f' => $fields]);
        try {
            app(CleanArchFacade::class)->generateNewEntity(
                $data['entity_name'],
                collect($fields)->map(fn ($f) => new FieldValue($f['type'], $f['title']))->all()
            );
        } catch (ExceptionFileAlreadyExists $e) {
            response()->json(['errors' => ['error' => 'Некоторые директории уже существовали']], 201);
        }
        return response()->json(['name' => $data['entity_name']], 201);
    }
}
