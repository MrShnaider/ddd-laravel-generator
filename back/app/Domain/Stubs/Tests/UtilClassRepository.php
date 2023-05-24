<?='<?php'?>
<?php
/** @var string $className*/
?>



namespace Tests\Feature\<?=$className?>;

use App\Domain\<?=$className?>\Create<?=$className?>Data;
use App\Domain\<?=$className?>\<?=$className?>Entity;
use App\Domain\<?=$className?>\<?=$className?>Repository;

class Util<?=$className?>Repository
{
    public function __construct() {
        $this->data = new Create<?=$className?>Data(
        );
    }

    private int $count = 1;
    private Create<?=$className?>Data $data;

    public function getCreate<?=$className?>Data(): Create<?=$className?>Data
    {
        return new Create<?=$className?>Data(
        );
    }

    public function next<?=$className?>(): void
    {
        $this->count++;
    }

    public function create<?=$className?>(): <?=$className?>Entity
    {
        return app(<?=$className?>Repository::class)->create<?=$className?>($this->getCreate<?=$className?>Data());
    }
}
