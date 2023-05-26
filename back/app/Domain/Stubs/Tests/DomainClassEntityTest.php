<?='<?php'?>
<?php
/** @var string $className*/
/** @var string $objectName*/
/** @var \App\Domain\Renderer\FieldValue $fields*/
?>



namespace Tests\Feature\<?=$className?>;

use App\Domain\<?=$className?>\<?=$className?>Repository;
use App\Domain\<?=$className?>\<?=$className?>Data;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class Domain<?=$className?>EntityTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function <?=$objectName?>_hasProperDataAfterCreation()
    {
        $createData = app(Util<?=$className?>Repository::class)->getCreate<?=$className?>Data();
        $<?=$objectName?> = app(<?=$className?>Repository::class)->create<?=$className?>($createData);
        $data = $<?=$objectName?>->getData();
        $this->assertInstanceOf(<?=$className?>Data::class, $data);
        $this->assertEquals($createData->id, $data->id);
<?php foreach ($fields as $field): ?>
        $this->assertEquals($createData-><?= $field->name ?>, $data-><?= $field->name ?>);
<?php endforeach;?>
    }
}
