<?php

namespace App\Http\Controllers;

use App\Http\JsonRequest;
use App\Models\Project;
use Illuminate\Http\JsonResponse;

class ProjectController extends Controller
{
    public function store(JsonRequest $r): JsonResponse
    {
        $r->validate([
            'title' => 'string|required',
            'directory' => 'string|required'
        ]);
        $title = $r->input('title');
        $directory = $r->input('directory');

        if (!file_exists($directory) || !is_dir($directory))
            return response()->json(['errors' => ['directory' => 'Такой директории не существует']], 422);
        if (!is_null(Project::firstWhere('title', $title)))
            return response()->json(['errors' => ['title' => 'Проект с таким названием уже существует']], 422);
        $p = Project::make();
        $p->title = $title;
        $p->directory = $directory;
        $p->save();

        return response()->json(null, 201);
    }

    public function index(): JsonResponse
    {
        $result = [];
        foreach (Project::all()->all() as $key => $project) {
            $result[] = [
                'title' => $project->title,
                'directory' => $project->directory
            ];
        }
        return response()->json($result);
    }

    public function destroy(JsonRequest $r): JsonResponse
    {
        $r->validate([
            'title' => 'string|required'
        ]);
        $title = $r->get('title');

        $p = Project::firstWhere('title', $title);
        if (is_null($p))
            response()->json(['errors' => ['title' => 'Такого проекта не существует']], 422);
        $p->delete();

        return response()->json(null, 201);
    }
}
