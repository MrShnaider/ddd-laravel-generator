<?php

namespace Tests\Feature\CleanArchFacade;

use App\Domain\CleanArchFacade\CleanArchFacade;
use App\Domain\FileGenerator\FileGenerator;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use Tests\TestCase;

class CleanArchFacadeTest extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();
        $fs = new Filesystem();
        $fs->remove($this->domainDirectoryPath);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->facade = new CleanArchFacade();
        $this->domainDirectoryPath = Path::join(app_path(), 'Domain', $this->entityName);
        $this->testStubDirectory = Path::join(__DIR__, '../Renderer');
    }

    private string $domainDirectoryPath;
    private CleanArchFacade $facade;
    private string $entityName = 'Offer';
    private string $testStubDirectory;

    /** @test */
    public function facade_canCreateEntity()
    {
        $this->facade->generateDomain($this->entityName);
        // Entity
        $this->generateAndCheckFile(
            "{$this->entityName}Entity.php",
            'Domain/OfferEntity.txt'
        );
        // CreateData
        $this->generateAndCheckFile(
            "Create{$this->entityName}Data.php",
            'Domain/CreateOfferData.txt'
        );
        // Data
        $this->generateAndCheckFile(
            "{$this->entityName}Data.php",
            'Domain/OfferData.txt'
        );
        // Repository
        $this->generateAndCheckFile(
            "{$this->entityName}Repository.php",
            'Domain/OfferRepository.txt'
        );
    }

    private function generateAndCheckFile(string $fileName, string $testStubFileName)
    {
        $filePath = Path::join($this->domainDirectoryPath, $fileName);
        $this->assertEquals(
            file_get_contents(Path::join($this->testStubDirectory, $testStubFileName)),
            file_get_contents($filePath)
        );
    }
}
