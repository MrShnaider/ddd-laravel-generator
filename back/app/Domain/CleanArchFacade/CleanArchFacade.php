<?php


namespace App\Domain\CleanArchFacade;


use App\Domain\FileGenerator\FileGenerator;
use App\Domain\Renderer\Renderer;

class CleanArchFacade
{
    private Renderer $renderer;
    private FileGenerator $fileGenerator;

    public function generateDomain(string $entityName)
    {
        $entityName = str($entityName)->studly();
        $this->renderer = new Renderer($entityName);
        $this->fileGenerator = new FileGenerator();

        $this->generateFile(Directories::DOMAIN_ENTITY($entityName), StubDirectories::DOMAIN_ENTITY());
        $this->generateFile(Directories::DOMAIN_REPOSITORY($entityName), StubDirectories::DOMAIN_REPOSITORY());
        $this->generateFile(Directories::DOMAIN_DATA($entityName), StubDirectories::DOMAIN_DATA());
        $this->generateFile(Directories::DOMAIN_CREATE_DATA($entityName), StubDirectories::DOMAIN_CREATE_DATA());
    }

    public function generateInfrastructure(string $entityName)
    {
        $entityName = str($entityName)->studly();
        $this->renderer = new Renderer($entityName);
        $this->fileGenerator = new FileGenerator();
        $this->generateFile(Directories::INFR_ENTITY($entityName), StubDirectories::INF_ENTITY());
        $this->generateFile(Directories::INFR_REPOSITORY($entityName), StubDirectories::INFR_REPOSITORY());
    }

    private function generateFile(string $resultFilePath, string $stubFilePath)
    {
        $content = $this->renderer->getRenderedStub($stubFilePath);
        $this->fileGenerator->createFile($resultFilePath, $content);
    }
}
