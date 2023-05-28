<?php


namespace App\Domain\CleanArchFacade;


use Symfony\Component\Filesystem\Path;

class Directories
{
    public static string $basePath;

    public static function DOMAIN_ENTITY(string $name): string
    {
        return Path::join(self::$basePath, 'app/Domain', "{$name}/{$name}Entity.php");
    }

    public static function DOMAIN_REPOSITORY(string $name): string
    {
        return Path::join(self::$basePath, 'app/Domain', "{$name}/{$name}Repository.php");
    }

    public static function DOMAIN_CREATE_DATA(string $name): string
    {
        return Path::join(self::$basePath, 'app/Domain', "{$name}/Create{$name}Data.php");
    }

    public static function DOMAIN_DATA(string $name): string
    {
        return Path::join(self::$basePath, 'app/Domain', "{$name}/{$name}Data.php");
    }

    public static function INFR_ENTITY(string $name): string
    {
        return Path::join(self::$basePath, 'app/Infrastructure', 'DomainImpl', "{$name}Laravel", "{$name}EntityEloquent.php");
    }

    public static function INFR_REPOSITORY(string $name): string
    {
        return Path::join(self::$basePath, 'app/Infrastructure', 'DomainImpl', "{$name}Laravel", "{$name}RepositoryEloquent.php");
    }

    public static function TEST_ENTITY(string $name): string
    {
        return Path::join(self::$basePath, 'tests/Feature', $name, "Domain{$name}EntityTest.php");
    }

    public static function TEST_REPOSITORY(string $name): string
    {
        return Path::join(self::$basePath, 'tests/Feature', $name, "Domain{$name}RepositoryTest.php");
    }

    public static function TEST_UTIL_REPOSITORY(string $name): string
    {
        return Path::join(self::$basePath, 'tests/Feature', $name, "Util{$name}Repository.php");
    }

    public static function MODEL_ENTITY(string $name): string
    {
        return Path::join(self::$basePath, 'app/Models', "{$name}.php");
    }

    public static function MODEL_MIGRATION(string $name): string
    {
        $now = now();
        $year = $now->year;
        $month = str_pad($now->month, 2, '0', STR_PAD_LEFT);
        $day = str_pad($now->day, 2, '0', STR_PAD_LEFT);
        $ms = str_pad($now->secondsSinceMidnight(), 6, '0', STR_PAD_LEFT);
        $name = str($name)->snake()->plural();
        $result = "{$year}_{$month}_{$day}_{$ms}_create_{$name}_table.php";
        return Path::join(self::$basePath, 'database/migrations', $result);
    }
}
