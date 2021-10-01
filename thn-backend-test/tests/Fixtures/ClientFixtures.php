<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Fixtures;

use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Thn\BackendTest\Domain\Model\Client\ClientRoom;
use Thn\BackendTest\Domain\Model\Country\CountryIso;
use Thn\BackendTest\Domain\Model\Email\Email;
use Thn\BackendTest\Domain\Model\Client\ClientId;
use Thn\BackendTest\Domain\Model\Client\ClientName;
use Thn\BackendTest\Domain\Model\Room\RoomId;
use Thn\BackendTest\Tests\Unit\Domain\Model\Client\ClientMother;

class ClientFixtures extends AbstractFixture implements ORMFixtureInterface
{
    private const FILE = 'tests/Fixtures/data/clients.json';

    /** @var \Doctrine\Persistence\ObjectManager */
    private $manager;

    public function load($manager)
    {
        $this->manager = $manager;
        $content = file_get_contents(self::FILE);
        $data = json_decode($content, true);

        foreach ($data as $clientData) {
            $clientId = new ClientId($clientData['id']);

            $client = ClientMother::withParameters(
                $clientId,
                new ClientName($clientData['name']),
                new Email($clientData['email']),
                new CountryIso($clientData['countryIso'])
            );

            $manager->persist($client);

            if (true === isset($clientData['clientRoomsData'])) {
                foreach ($clientData['clientRoomsData'] as $roomId) {
                    $manager->persist(
                        new ClientRoom(
                            $clientId,
                            new RoomId($roomId)
                        )
                    );
                }
            }
        }

        $manager->flush();
    }
}
