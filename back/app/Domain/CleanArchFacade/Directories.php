<?php


namespace App\Domain\CleanArchFacade;


use Symfony\Component\Filesystem\Path;

class Directories
{
    public static function DOMAIN_ENTITY(string $name): string
    {
        return Path::join(app_path(), 'Domain', "{$name}/{$name}Entity.php");
    }

    public static function DOMAIN_REPOSITORY(string $name): string
    {
        return Path::join(app_path(), 'Domain', "{$name}/{$name}Repository.php");
    }

    public static function DOMAIN_CREATE_DATA(string $name): string
    {
        return Path::join(app_path(), 'Domain', "{$name}/Create{$name}Data.php");
    }

    public static function DOMAIN_DATA(string $name): string
    {
        return Path::join(app_path(), 'Domain', "{$name}/{$name}Data.php");
    }

    public static function INFR_ENTITY(string $name): string
    {
        return Path::join(app_path(), 'Infrastructure', 'DomainImpl', "{$name}Laravel", "{$name}EntityEloquent.php");
    }

    public static function INFR_REPOSITORY(string $name): string
    {
        return Path::join(app_path(), 'Infrastructure', 'DomainImpl', "{$name}Laravel", "{$name}RepositoryEloquent.php");
    }

    public static function TEST_ENTITY(string $name): string
    {
        return Path::join(app_path(), '../tests/Feature', $name, "Domain{$name}EntityTest.php");
    }

    public static function TEST_REPOSITORY(string $name): string
    {
        return Path::join(app_path(), '../tests/Feature', $name, "Domain{$name}RepositoryTest.php");
    }

    public static function TEST_UTIL_REPOSITORY(string $name): string
    {
        return Path::join(app_path(), '../tests/Feature', $name, "Util{$name}Repository.php");
    }
}
