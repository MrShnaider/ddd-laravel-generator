<?php

namespace Tests\Feature\FileGenerator;

use App\Domain\FileGenerator\FileGenerator;
use Tests\TestCase;

class FileGeneratorTest extends TestCase
{
    /** @test */
    public function generator_canCreateFile()
    {
        $filePath = __DIR__.'/TestDirectory/ExampleFile.php';
        $content = 'some file content';
        $g = new FileGenerator();

        $g->createFile($filePath, $content);

        $fileContent = file_get_contents($filePath);
        $this->assertEquals($fileContent, $content);
        $g->deleteFile($filePath);
    }
}
