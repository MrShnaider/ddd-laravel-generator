<?php

namespace Tests\Feature\CleanArchFacade;

use App\Domain\CleanArchFacade\CleanArchFacade;
use App\Domain\CleanArchFacade\Directories;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use Tests\Feature\Renderer\TestReferenceStubs;
use Tests\TestCase;

class CleanArchFacadeTest extends TestCase
{
    protected function tearDown(): void
    {
        parent::tearDown();
        app(Filesystem::class)->remove($this->currentGenerationDirectoryPath);
    }

    protected function setUp(): void
    {
        parent::setUp();
        Directories::$basePath = app_path('Clean');
    }

    private static string $entityName = 'Offer';
    private string $currentGenerationDirectoryPath;

    /** @test */
    public function facade_canCreateDomain()
    {
        app(CleanArchFacade::class)->generateDomain(self::$entityName);
        $this->currentGenerationDirectoryPath = Path::getDirectory(Directories::DOMAIN_ENTITY(self::$entityName));
        // Entity
        $this->generateAndCheckFile(
            Directories::DOMAIN_ENTITY(self::$entityName),
            TestReferenceStubs::DOMAIN_ENTITY()
        );
        // CreateData
        $this->generateAndCheckFile(
            Directories::DOMAIN_CREATE_DATA(self::$entityName),
            TestReferenceStubs::DOMAIN_CREATE_DATA()
        );
        // Data
        $this->generateAndCheckFile(
            Directories::DOMAIN_DATA(self::$entityName),
            TestReferenceStubs::DOMAIN_DATA()
        );
        // Repository
        $this->generateAndCheckFile(
            Directories::DOMAIN_REPOSITORY(self::$entityName),
            TestReferenceStubs::DOMAIN_REPOSITORY()
        );
    }

    /** @test */
    public function facade_canCreateInfrastructure()
    {
        app(CleanArchFacade::class)->generateInfrastructure(self::$entityName);
        $this->currentGenerationDirectoryPath = Path::getDirectory(Directories::INFR_ENTITY(self::$entityName));
        // Entity
        $this->generateAndCheckFile(
            Directories::INFR_ENTITY(self::$entityName),
            TestReferenceStubs::INFR_ENTITY()
        );
        // Repository
        $this->generateAndCheckFile(
            Directories::INFR_REPOSITORY(self::$entityName),
            TestReferenceStubs::INFR_REPOSITORY()
        );
    }

    /** @test */
    public function facade_canCreateTests()
    {
        app(CleanArchFacade::class)->generateTests(self::$entityName);
        $this->currentGenerationDirectoryPath = Path::getDirectory(Directories::TEST_ENTITY(self::$entityName));
        // Entity
        $this->generateAndCheckFile(
            Directories::TEST_ENTITY(self::$entityName),
            TestReferenceStubs::TEST_ENTITY()
        );
        // Repository
        $this->generateAndCheckFile(
            Directories::TEST_REPOSITORY(self::$entityName),
            TestReferenceStubs::TEST_REPOSITORY()
        );
        // UtilRepository
        $this->generateAndCheckFile(
            Directories::TEST_UTIL_REPOSITORY(self::$entityName),
            TestReferenceStubs::TEST_UTIL_REPOSITORY()
        );
    }

    private function generateAndCheckFile(string $filePath, string $testStubFilePath)
    {
        $this->assertEquals(
            file_get_contents($filePath),
            file_get_contents($testStubFilePath)
        );
    }
}
