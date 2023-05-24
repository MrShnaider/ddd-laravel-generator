<?php

namespace App\Domain\Renderer;

class Renderer
{
    private string $className;
    private string $objectName;

    public function __construct(string $className) {
        $this->className = str($className)->studly()->value();
        $this->objectName = str($className)->camel()->value();
    }

    public function getRenderedStub(string $fullPathToStub): string
    {
        [$className, $objectName] = $this->declareVars();
        ob_start();
        require $fullPathToStub;
        $result = ob_get_contents();
        ob_end_clean();

        return $result ?: '';
    }

    private function declareVars(): array
    {
        return [$this->className, $this->objectName];
    }
}
