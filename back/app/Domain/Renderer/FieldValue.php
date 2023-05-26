<?php


namespace App\Domain\Renderer;


class FieldValue
{
    public function __construct(
        public string $type,
        public string $name
    ) {}
}
