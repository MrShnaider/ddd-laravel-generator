<?='<?php'?>
<?php
/** @var string $className*/
/** @var string $objectName*/
?>



namespace Tests\Feature\<?=$className?>;

use App\Domain\<?=$className?>\<?=$className?>Repository;
use App\Domain\<?=$className?>\<?=$className?>Entity;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class Domain<?=$className?>RepositoryTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function repository_returnNull_whenGetNonExistent<?=$className?>()
    {
        $<?=$objectName?> = app(<?=$className?>Repository::class)->get<?=$className?>ById(-1);
        $this->assertNull($<?=$objectName?>);
    }

    /** @test */
    public function repository_canCreate<?=$className?>(){
        $data = app(Util<?=$className?>Repository::class)->getCreate<?=$className?>Data();
        $<?=$objectName?> = app(<?=$className?>Repository::class)->create<?=$className?>($data);
        $this->assertInstanceOf(<?=$className?>Entity::class, $<?=$objectName?>);
    }
}
