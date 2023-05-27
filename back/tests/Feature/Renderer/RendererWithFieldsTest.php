<?php

namespace Tests\Feature\Renderer;

use App\Domain\CleanArchFacade\Directories;
use App\Domain\CleanArchFacade\StubDirectories;
use App\Domain\Renderer\FieldValue;
use App\Domain\Renderer\Renderer;
use Tests\TestCase;

class RendererWithFieldsTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->renderer = new Renderer('offer', [
            new FieldValue('string', 'title'),
            new FieldValue('int', 'price'),
        ]);
        Directories::$basePath = app_path();
    }

    private Renderer $renderer;

    /** @test */
    public function renderer_canRender_createClassData()
    {
        $result = $this->renderer->getRenderedStub(StubDirectories::DOMAIN_CREATE_DATA());
        $example = file_get_contents(__DIR__.'/WithFields/Domain/CreateOfferData.txt');
        $this->assertEquals($example, $result);
    }

    /** @test */
    public function renderer_canRender_classData()
    {
        $result = $this->renderer->getRenderedStub(StubDirectories::DOMAIN_DATA());
        $example = file_get_contents(__DIR__.'/WithFields/Domain/OfferData.txt');
        $this->assertEquals($example, $result);
    }

    /** @test */
    public function renderer_canRender_classEntityEloquent()
    {
        $result = $this->renderer->getRenderedStub(StubDirectories::INF_ENTITY());
        $example = file_get_contents(__DIR__.'/WithFields/Infrastructure/OfferEntityEloquent.txt');
        $this->assertEquals($example, $result);
    }

    /** @test */
    public function renderer_canRender_testClassEntity()
    {
        $result = $this->renderer->getRenderedStub(StubDirectories::TEST_ENTITY());
        $example = file_get_contents(__DIR__.'/WithFields/Tests/DomainOfferEntityTest.txt');
        $this->assertEquals($example, $result);
    }

    /** @test */
    public function renderer_canRender_testUtilRepository()
    {
        $result = $this->renderer->getRenderedStub(StubDirectories::TEST_UTIL_REPOSITORY());
        $example = file_get_contents(__DIR__.'/WithFields/Tests/UtilOfferRepository.txt');
        $this->assertEquals($example, $result);
    }
}
