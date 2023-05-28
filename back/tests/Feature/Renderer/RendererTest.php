<?php

namespace Tests\Feature\Renderer;

use App\Domain\Renderer\Renderer;
use Tests\TestCase;

class RendererTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->renderer = new Renderer('offer');
    }

    private Renderer $renderer;

    /** DOMAIN */

    /** @test */
    public function renderer_canRenderRepository()
    {
        $example = $this->getExample('Domain/OfferRepository.txt');
        $result = $this->renderStub('Domain/ClassRepository.php');
        $this->assertEquals($example, $result);
    }

    /** @test */
    public function renderer_canRenderEntity()
    {
        $example = $this->getExample('Domain/OfferEntity.txt');
        $result = $this->renderStub('Domain/ClassEntity.php');
        $this->assertEquals($example, $result);
    }

    /** @test */
    public function renderer_canRenderCreateData()
    {
        $example = $this->getExample('Domain/CreateOfferData.txt');
        $result = $this->renderStub('Domain/CreateClassData.php');
        $this->assertEquals($example, $result);
    }

    /** @test */
    public function renderer_canRenderData()
    {
        $example = $this->getExample('Domain/OfferData.txt');
        $result = $this->renderStub('Domain/ClassData.php');
        $this->assertEquals($example, $result);
    }

    /** INFRASTRUCTURE */

    /** @test */
    public function renderer_canRenderEntityImpl()
    {
        $example = $this->getExample('Infrastructure/OfferEntityEloquent.txt');
        $result = $this->renderStub('Infrastructure/ClassEntityEloquent.php');
        $this->assertEquals($example, $result);
    }

    /** @test */
    public function renderer_canRenderRepositoryImpl()
    {
        $example = $this->getExample('Infrastructure/OfferRepositoryEloquent.txt');
        $result = $this->renderStub('Infrastructure/ClassRepositoryEloquent.php');
        $this->assertEquals($example, $result);
    }

    /** TESTS */

    /** @test */
    public function renderer_canRenderEntityTest()
    {
        $example = $this->getExample('Tests/DomainOfferEntityTest.txt');
        $result = $this->renderStub('Tests/DomainClassEntityTest.php');
        $this->assertEquals($example, $result);
    }

    /** @test */
    public function renderer_canRenderRepositoryTest()
    {
        $example = $this->getExample('Tests/DomainOfferRepositoryTest.txt');
        $result = $this->renderStub('Tests/DomainClassRepositoryTest.php');
        $this->assertEquals($example, $result);
    }

    /** @test */
    public function renderer_canRenderUtilRepository()
    {
        $example = $this->getExample('Tests/UtilOfferRepository.txt');
        $result = $this->renderStub('Tests/UtilClassRepository.php');
        $this->assertEquals($example, $result);
    }

    /** @test */
    public function renderer_canRenderModel()
    {
        $example = $this->getExample('Models/OfferModel.txt');
        $result = $this->renderStub('Models/ClassModel.php');
        $this->assertEquals($example, $result);
    }

    /** @test */
    public function renderer_canRenderMigration()
    {
        $example = $this->getExample('Models/OfferMigration.txt');
        $result = $this->renderStub('Models/ClassMigration.php');
        $this->assertEquals($example, $result);
    }

    private function renderStub(string $stubFile): string
    {
        return $this->renderer->getRenderedStub(app_path("Domain/Stubs/$stubFile"));
    }

    private function getExample(string $examplePath): string
    {
        return file_get_contents(__DIR__ . "/$examplePath");
    }
}
