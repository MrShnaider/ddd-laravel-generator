<?='<?php'?>
<?php
/** @var string $className*/
/** @var \App\Domain\Renderer\FieldValue $fields*/
?>



namespace App\Domain\<?=$className?>;


class <?=$className?>Data
{
    public function __construct(
        public int $id,
<?php foreach ($fields as $field): ?>
        public <?= $field->type ?> $<?= $field->name ?>,
<?php endforeach;?>
    ) {}
}
