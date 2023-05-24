<?php


namespace App\Domain\CleanArchFacade;


use App\Domain\FileGenerator\FileGenerator;
use App\Domain\Renderer\Renderer;
use Symfony\Component\Filesystem\Path;

class CleanArchFacade
{
    private string $domainDirectoryPath;
    private Renderer $renderer;
    private FileGenerator $fileGenerator;

    public function generateDomain(string $entityName)
    {
        $entityName = str($entityName)->studly();
        $this->renderer = new Renderer($entityName);
        $this->fileGenerator = new FileGenerator();
        $this->domainDirectoryPath = Path::join(app_path(), 'Domain', $entityName);

        $this->generateFile("{$entityName}Entity.php", 'Domain/ClassEntity.php');
        $this->generateFile("Create{$entityName}Data.php", 'Domain/CreateClassData.php');
        $this->generateFile("{$entityName}Data.php", 'Domain/ClassData.php');
        $this->generateFile("{$entityName}Repository.php", 'Domain/ClassRepository.php');
    }

    private function generateFile(string $resultFileName, string $stubFilePath)
    {
        $filePath = Path::join($this->domainDirectoryPath, $resultFileName);
        $content = $this->renderer->getRenderedStub(Path::join(__DIR__, '/../Stubs/', $stubFilePath));
        $this->fileGenerator->createFile($filePath, $content);
    }
}
