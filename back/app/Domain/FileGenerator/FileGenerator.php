<?php


namespace App\Domain\FileGenerator;


use Symfony\Component\Filesystem\Filesystem;

class FileGenerator
{
    /** @throws ExceptionFileAlreadyExists */
    public function createFile(string $filePath, string $content)
    {
        $this->ensureFileDoesNotExist($filePath);
        $fs = new Filesystem();
        $fs->appendToFile($filePath, $content);
    }

    public function deleteFile(string $fullFilePath)
    {
        if (!file_exists($fullFilePath))
            return;
        unlink($fullFilePath);
    }

    /** @throws ExceptionFileAlreadyExists */
    public function ensureFileDoesNotExist(string $filePath)
    {
        if (file_exists($filePath))
            throw new ExceptionFileAlreadyExists();
    }
}
