<?php

namespace App\Domain\Renderer;

class Renderer
{
    private string $className;
    private string $objectName;

    /**
     * @param string $className
     * @param FieldValue[] $fields
     */
    public function __construct(string $className, private array $fields = []) {
        $this->className = str($className)->studly()->value();
        $this->objectName = str($className)->camel()->value();
    }

    public function getRenderedStub(string $fullPathToStub): string
    {
        [$className, $objectName, $fields] = $this->declareVars();
        ob_start();
        require $fullPathToStub;
        $result = ob_get_contents();
        ob_end_clean();

        return $result ?: '';
    }

    private function declareVars(): array
    {
        return [$this->className, $this->objectName, $this->fields];
    }
}
