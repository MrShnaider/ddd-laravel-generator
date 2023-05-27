<?='<?php'?>
<?php
/** @var string $className*/
/** @var \App\Domain\Renderer\FieldValue $fields*/
?>



namespace App\Domain\<?=$className?>;


class Create<?=$className?>Data
{
    public function __construct(
<?php foreach ($fields as $field): ?>
        public <?= $field->type ?> $<?= $field->name ?>,
<?php endforeach;?>
    ) {}
}
