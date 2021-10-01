<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Fixtures;

use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Thn\BackendTest\Domain\Model\Room\RoomDescription;
use Thn\BackendTest\Domain\Model\Room\RoomFloor;
use Thn\BackendTest\Domain\Model\Room\RoomId;
use Thn\BackendTest\Domain\Model\Room\RoomNumber;
use Thn\BackendTest\Tests\Unit\Domain\Model\Room\RoomMother;

class RoomFixtures extends AbstractFixture implements ORMFixtureInterface
{
    private const FILE = 'tests/Fixtures/data/rooms.json';

    /** @var \Doctrine\Persistence\ObjectManager */
    private $manager;

    public function load($manager)
    {
        $this->manager = $manager;
        $content = file_get_contents(self::FILE);
        $data = json_decode($content, true);

        foreach ($data as $roomData) {
            $roomId = new RoomId($roomData['id']);

            $client = RoomMother::withParameters(
                $roomId,
                new RoomNumber($roomData['number']),
                new RoomFloor($roomData['floor']),
                new RoomDescription($roomData['description'])
            );

            $manager->persist($client);
        }

        $manager->flush();
    }
}
