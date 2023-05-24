<?php


namespace Tests\Feature\Renderer;


use Symfony\Component\Filesystem\Path;

class TestReferenceStubs
{
    public static function DOMAIN_ENTITY(): string
    {
        return Path::join(__DIR__, 'Domain/OfferEntity.txt');
    }

    public static function DOMAIN_REPOSITORY(): string
    {
        return Path::join(__DIR__, 'Domain/OfferRepository.txt');
    }

    public static function DOMAIN_CREATE_DATA(): string
    {
        return Path::join(__DIR__, 'Domain/CreateOfferData.txt');
    }

    public static function DOMAIN_DATA(): string
    {
        return Path::join(__DIR__, 'Domain/OfferData.txt');
    }

    public static function INFR_ENTITY(): string
    {
        return Path::join(__DIR__, 'Infrastructure/OfferEntityEloquent.txt');
    }

    public static function INFR_REPOSITORY(): string
    {
        return Path::join(__DIR__, 'Infrastructure/OfferRepositoryEloquent.txt');
    }
}
