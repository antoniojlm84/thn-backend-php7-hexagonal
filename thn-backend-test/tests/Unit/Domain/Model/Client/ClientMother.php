<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model\Client;

use ReflectionClass;
use Thn\BackendTest\Domain\Model\Country\CountryIso;
use Thn\BackendTest\Domain\Model\Email\Email;
use Thn\BackendTest\Domain\Model\Client\Client;
use Thn\BackendTest\Domain\Model\Client\ClientId;
use Thn\BackendTest\Domain\Model\Client\ClientName;
use Thn\BackendTest\Tests\Unit\Domain\Model\Mother;

final class ClientMother extends Mother
{
    public static function withId(ClientId $id): Client
    {
        $reflectionClass = new ReflectionClass(Client::class);

        /** @var Client $client */
        $client = $reflectionClass->newInstanceWithoutConstructor();

        $data = [
            'id' => $id,
            'name' => ClientNameMother::random(),
            'email' => ClientEmailMother::random(),
            'deleted' => false,
            'createdAt' => new \DateTimeImmutable('now'),
            'updatedAt' => new \DateTimeImmutable('now'),
            'countryIso' => new CountryIso(CountryIso::random())
        ];

        self::setProperties($reflectionClass, $client, $data);

        return $client;
    }

    public static function random(): Client
    {
        return self::withId(ClientId::random());
    }

    public static function withParameters(
        ClientId $id,
        ClientName $name,
        Email $email,
        CountryIso $countryIso
    ): Client {
        $reflectionClass = new ReflectionClass(Client::class);

        /** @var Client $client */
        $client = $reflectionClass->newInstanceWithoutConstructor();

        $data = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'deleted' => false,
            'createdAt' => new \DateTimeImmutable('now'),
            'updatedAt' => new \DateTimeImmutable('now'),
            'countryIso' => $countryIso,
        ];

        self::setProperties($reflectionClass, $client, $data);

        return $client;
    }
}
