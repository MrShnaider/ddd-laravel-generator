<?php


namespace App\Domain\Renderer;


class FieldValue
{
    public string $testValue;

    public function __construct(
        public string $type,
        public string $name,
    ) {
        $this->testValue = match ($type) {
            'string' => "''",
            'int' => '0',
        };
    }
}
