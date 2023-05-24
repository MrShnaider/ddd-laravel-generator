<?php


namespace App\Domain\FileGenerator;


use Symfony\Component\Filesystem\Filesystem;

class FileGenerator
{
    /**
     * @throws ExceptionFileAlreadyExists
     */
    public function createFile(string $filePath, string $content)
    {
        if (file_exists($filePath))
            throw new ExceptionFileAlreadyExists();
        $fs = new Filesystem();
        $fs->appendToFile($filePath, $content);
    }

    public function deleteFile(string $fullFilePath)
    {
        if (!file_exists($fullFilePath))
            return;
        unlink($fullFilePath);
    }
}
