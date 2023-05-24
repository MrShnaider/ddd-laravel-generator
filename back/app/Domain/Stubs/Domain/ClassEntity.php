<?='<?php'?>
<?php
/** @var string $className*/
?>



namespace App\Domain\<?=$className?>;


abstract class <?=$className?>Entity
{
    abstract public function getId(): int;
    abstract public function getData(): <?=$className?>Data;
}
