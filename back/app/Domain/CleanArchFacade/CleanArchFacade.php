<?php


namespace App\Domain\CleanArchFacade;


use App\Domain\FileGenerator\ExceptionFileAlreadyExists;
use App\Domain\FileGenerator\FileGenerator;
use App\Domain\Renderer\FieldValue;
use App\Domain\Renderer\Renderer;
use Symfony\Component\Filesystem\Path;

class CleanArchFacade
{
    private Renderer $renderer;
    private FileGenerator $fileGenerator;

    /**
     * @param string $entityName
     * @param FieldValue[] $fields
     * @throws ExceptionFileAlreadyExists
     */
    public function generateDomain(string $entityName, array $fields = [])
    {
        $entityName = str($entityName)->studly();
        $this->renderer = new Renderer($entityName, $fields);
        $this->fileGenerator = new FileGenerator();
        $this->fileGenerator->ensureFileDoesNotExist(Path::getDirectory(Directories::DOMAIN_ENTITY($entityName)));

        $this->generateFile(Directories::DOMAIN_ENTITY($entityName), StubDirectories::DOMAIN_ENTITY());
        $this->generateFile(Directories::DOMAIN_REPOSITORY($entityName), StubDirectories::DOMAIN_REPOSITORY());
        $this->generateFile(Directories::DOMAIN_DATA($entityName), StubDirectories::DOMAIN_DATA());
        $this->generateFile(Directories::DOMAIN_CREATE_DATA($entityName), StubDirectories::DOMAIN_CREATE_DATA());
    }

    /** @throws ExceptionFileAlreadyExists */
    public function generateInfrastructure(string $entityName, array $fields = [])
    {
        $entityName = str($entityName)->studly();
        $this->renderer = new Renderer($entityName, $fields);
        $this->fileGenerator = new FileGenerator();
        $this->fileGenerator->ensureFileDoesNotExist(Path::getDirectory(Directories::INFR_ENTITY($entityName)));

        $this->generateFile(Directories::INFR_ENTITY($entityName), StubDirectories::INF_ENTITY());
        $this->generateFile(Directories::INFR_REPOSITORY($entityName), StubDirectories::INFR_REPOSITORY());
    }

    /** @throws ExceptionFileAlreadyExists */
    public function generateTests(string $entityName, array $fields = [])
    {
        $entityName = str($entityName)->studly();
        $this->renderer = new Renderer($entityName, $fields);
        $this->fileGenerator = new FileGenerator();
        $this->fileGenerator->ensureFileDoesNotExist(Path::getDirectory(Directories::TEST_ENTITY($entityName)));

        $this->generateFile(Directories::TEST_ENTITY($entityName), StubDirectories::TEST_ENTITY());
        $this->generateFile(Directories::TEST_REPOSITORY($entityName), StubDirectories::TEST_REPOSITORY());
        $this->generateFile(Directories::TEST_UTIL_REPOSITORY($entityName), StubDirectories::TEST_UTIL_REPOSITORY());
    }

    /** @throws ExceptionFileAlreadyExists */
    public function generateModel(string $entityName, array $fields = [])
    {
        $entityName = str($entityName)->studly();
        $this->renderer = new Renderer($entityName, $fields);
        $this->fileGenerator = new FileGenerator();
        $this->generateFile(Directories::MODEL_ENTITY($entityName), StubDirectories::MODEL_ENTITY());
    }

    /** @throws ExceptionFileAlreadyExists */
    public function generateMigration(string $entityName, array $fields = [])
    {
        $entityName = str($entityName)->studly();
        $this->renderer = new Renderer($entityName, $fields);
        $this->fileGenerator = new FileGenerator();
        $this->generateFile(Directories::MODEL_MIGRATION($entityName), StubDirectories::MODEL_MIGRATION());
    }

    /**
     * @param string $entityName
     * @param FieldValue[] $fields
     * @throws ExceptionFileAlreadyExists
     */
    public function generateNewEntity(string $entityName, array $fields = [])
    {
        $this->generateDomain($entityName, $fields);
        $this->generateInfrastructure($entityName, $fields);
        $this->generateTests($entityName, $fields);
        $this->generateModel($entityName, $fields);
        $this->generateMigration($entityName, $fields);
    }

    /** @throws ExceptionFileAlreadyExists */
    private function generateFile(string $resultFilePath, string $stubFilePath)
    {
        $content = $this->renderer->getRenderedStub($stubFilePath);
        $this->fileGenerator->createFile($resultFilePath, $content);
    }
}
