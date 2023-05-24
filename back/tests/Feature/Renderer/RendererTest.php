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

    private function renderStub(string $stubFile): string
    {
        return $this->renderer->getRenderedStub(app_path("Domain/Stubs/$stubFile"));
    }

    private function getExample(string $examplePath): string
    {
        return file_get_contents(__DIR__ . "/$examplePath");
    }
}
