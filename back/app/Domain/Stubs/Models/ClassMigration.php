<?='<?php'?>

<?php
/** @var \App\Domain\Renderer\FieldValue[] $fields*/
/** @var string $objectName*/
$db_name = str($objectName)->snake()->plural()->toString();
?>

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('<?=$db_name?>', function (Blueprint $table) {
            $table->id();
<?php foreach ($fields as $field): ?>
            $table-><?=$field->db_type?>('<?=$field->db_name?>');
<?php endforeach;?>
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('<?=$db_name?>');
    }
};
