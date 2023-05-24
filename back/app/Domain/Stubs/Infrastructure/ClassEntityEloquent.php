<?='<?php'?>
<?php
/** @var string $className*/
/** @var string $objectName*/
?>



namespace App\Infrastructure\DomainImpl\<?=$className?>Laravel;


use App\Domain\<?=$className?>\<?=$className?>Data;
use App\Domain\<?=$className?>\<?=$className?>Entity;
use App\Models\<?=$className?>;

class <?=$className?>EntityEloquent extends <?=$className?>Entity
{
    public function __construct(
        public <?=$className?> $<?=$objectName?>Model
    ) {}

    public function getId(): int
    {
        return $this-><?=$objectName?>Model->id;
    }

    public function getData(): <?=$className?>Data
    {
        $this-><?=$objectName?>Model->refresh();
        return new <?=$className?>Data(
            id: $this->getId()
        );
    }
}
