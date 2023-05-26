<?='<?php'?>
<?php
/** @var string $className*/
/** @var string $objectName*/
/** @var \App\Domain\Renderer\FieldValue $fields*/
?>



namespace App\Infrastructure\DomainImpl\<?=$className?>Laravel;


use App\Domain\<?=$className?>\Create<?=$className?>Data;
use App\Domain\<?=$className?>\<?=$className?>Entity;
use App\Domain\<?=$className?>\<?=$className?>Repository;
use App\Models\<?=$className?>;

class <?=$className?>RepositoryEloquent extends <?=$className?>Repository
{
    public function create<?=$className?>(Create<?=$className?>Data $data): <?=$className?>Entity
    {
        $<?=$objectName?>Model = <?=$className?>::make();
<?php foreach ($fields as $field): ?>
        $<?=$objectName?>Model-><?= $field->name ?> = $data-><?= $field->name ?>;
<?php endforeach;?>
        $<?=$objectName?>Model->save();

        return $this->get<?=$className?>ByModel($<?=$objectName?>Model);
    }

    public function get<?=$className?>ById(int $<?=$objectName?>Id): ?<?=$className?>Entity
    {
        $<?=$objectName?>Model = <?=$className?>::firstWhere('id', $<?=$objectName?>Id);
        if ($<?=$objectName?>Model == null)
            return null;

        return new <?=$className?>EntityEloquent($<?=$objectName?>Model);
    }

    public function get<?=$className?>ByModel(<?=$className?> $<?=$objectName?>Model): ?<?=$className?>Entity
    {
        return new <?=$className?>EntityEloquent($<?=$objectName?>Model);
    }
}
