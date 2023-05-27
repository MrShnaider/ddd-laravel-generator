<?php


namespace App\Domain\CleanArchFacade;


use Symfony\Component\Filesystem\Path;

class StubDirectories
{
    public static function DOMAIN_ENTITY(): string
    {
        return Path::join(app_path(), 'Domain/Stubs/Domain', "ClassEntity.php");
    }

    public static function DOMAIN_REPOSITORY(): string
    {
        return Path::join(app_path(), 'Domain/Stubs/Domain', "ClassRepository.php");
    }

    public static function DOMAIN_CREATE_DATA(): string
    {
        return Path::join(app_path(), 'Domain/Stubs/Domain', "CreateClassData.php");
    }

    public static function DOMAIN_DATA(): string
    {
        return Path::join(app_path(), 'Domain/Stubs/Domain', "ClassData.php");
    }

    public static function INF_ENTITY(): string
    {
        return Path::join(app_path(), 'Domain/Stubs/Infrastructure', "ClassEntityEloquent.php");
    }

    public static function INFR_REPOSITORY(): string
    {
        return Path::join(app_path(), 'Domain/Stubs/Infrastructure', "ClassRepositoryEloquent.php");
    }

    public static function TEST_ENTITY(): string
    {
        return Path::join(app_path(), 'Domain/Stubs/Tests', "DomainClassEntityTest.php");
    }

    public static function TEST_REPOSITORY(): string
    {
        return Path::join(app_path(), 'Domain/Stubs/Tests', "DomainClassRepositoryTest.php");
    }

    public static function TEST_UTIL_REPOSITORY(): string
    {
        return Path::join(app_path(), 'Domain/Stubs/Tests', "UtilClassRepository.php");
    }

    public static function MODEL_ENTITY(): string
    {
        return Path::join(app_path(), 'Domain/Stubs/Models', "ClassModel.php");
    }
}
