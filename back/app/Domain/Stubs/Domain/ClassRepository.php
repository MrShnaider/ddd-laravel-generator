<?='<?php'?>
<?php
/** @var string $className*/
/** @var string $objectName*/
?>



namespace App\Domain\<?=$className?>;


abstract class <?=$className?>Repository
{
    abstract public function create<?=$className?>(Create<?=$className?>Data $data): <?=$className?>Entity;
    abstract public function get<?=$className?>ById(int $<?=$objectName?>Id): ?<?=$className?>Entity;
}
