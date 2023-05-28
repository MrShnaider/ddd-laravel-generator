<?php


namespace App\Domain\Renderer;


class FieldValue
{
    public string $testValue;
    public string $db_type;
    public string $db_name;

    public function __construct(
        public string $type,
        public string $name,
    ) {
        $this->testValue = match ($type) {
            'string' => "''",
            'int' => '0',
        };
        $this->db_type = match ($type) {
            'string' => 'string',
            'int' => 'integer',
        };
        $this->db_name = str($this->name)->snake()->toString();
    }
}
