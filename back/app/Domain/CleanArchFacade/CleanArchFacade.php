<?php


namespace App\Domain\CleanArchFacade;


use App\Domain\FileGenerator\ExceptionFileAlreadyExists;
use App\Domain\FileGenerator\FileGenerator;
use App\Domain\Renderer\Renderer;
use Symfony\Component\Filesystem\Path;

class CleanArchFacade
{
    private Renderer $renderer;
    private FileGenerator $fileGenerator;

    /** @throws ExceptionFileAlreadyExists */
    public function generateDomain(string $entityName)
    {
        $entityName = str($entityName)->studly();
        $this->renderer = new Renderer($entityName);
        $this->fileGenerator = new FileGenerator();
        $this->fileGenerator->ensureFileDoesNotExist(Path::getDirectory(Directories::DOMAIN_ENTITY($entityName)));

        $this->generateFile(Directories::DOMAIN_ENTITY($entityName), StubDirectories::DOMAIN_ENTITY());
        $this->generateFile(Directories::DOMAIN_REPOSITORY($entityName), StubDirectories::DOMAIN_REPOSITORY());
        $this->generateFile(Directories::DOMAIN_DATA($entityName), StubDirectories::DOMAIN_DATA());
        $this->generateFile(Directories::DOMAIN_CREATE_DATA($entityName), StubDirectories::DOMAIN_CREATE_DATA());
    }

    /** @throws ExceptionFileAlreadyExists */
    public function generateInfrastructure(string $entityName)
    {
        $entityName = str($entityName)->studly();
        $this->renderer = new Renderer($entityName);
        $this->fileGenerator = new FileGenerator();
        $this->fileGenerator->ensureFileDoesNotExist(Path::getDirectory(Directories::INFR_ENTITY($entityName)));

        $this->generateFile(Directories::INFR_ENTITY($entityName), StubDirectories::INF_ENTITY());
        $this->generateFile(Directories::INFR_REPOSITORY($entityName), StubDirectories::INFR_REPOSITORY());
    }

    /** @throws ExceptionFileAlreadyExists */
    public function generateTests(string $entityName)
    {
        $entityName = str($entityName)->studly();
        $this->renderer = new Renderer($entityName);
        $this->fileGenerator = new FileGenerator();
        $this->fileGenerator->ensureFileDoesNotExist(Path::getDirectory(Directories::TEST_ENTITY($entityName)));

        $this->generateFile(Directories::TEST_ENTITY($entityName), StubDirectories::TEST_ENTITY());
        $this->generateFile(Directories::TEST_REPOSITORY($entityName), StubDirectories::TEST_REPOSITORY());
        $this->generateFile(Directories::TEST_UTIL_REPOSITORY($entityName), StubDirectories::TEST_UTIL_REPOSITORY());
    }

    /** @throws ExceptionFileAlreadyExists */
    public function generateNewEntity(string $entityName)
    {
        $this->generateDomain($entityName);
        $this->generateInfrastructure($entityName);
        $this->generateTests($entityName);
    }

    /** @throws ExceptionFileAlreadyExists */
    private function generateFile(string $resultFilePath, string $stubFilePath)
    {
        $content = $this->renderer->getRenderedStub($stubFilePath);
        $this->fileGenerator->createFile($resultFilePath, $content);
    }
}
