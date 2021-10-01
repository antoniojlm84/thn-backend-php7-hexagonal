<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Fixtures;

use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Thn\BackendTest\Domain\Model\Country\CountryIso;
use Thn\BackendTest\Domain\Model\Email\Email;
use Thn\BackendTest\Domain\Model\Hotel\HotelCity;
use Thn\BackendTest\Domain\Model\Hotel\HotelId;
use Thn\BackendTest\Domain\Model\Hotel\HotelName;
use Thn\BackendTest\Domain\Model\Hotel\HotelPhone;
use Thn\BackendTest\Domain\Model\Hotel\HotelRoom;
use Thn\BackendTest\Domain\Model\Room\RoomId;
use Thn\BackendTest\Tests\Unit\Domain\Model\Hotel\HotelMother;

class HotelFixtures extends AbstractFixture implements ORMFixtureInterface
{
    private const FILE = 'tests/Fixtures/data/hotels.json';

    /** @var \Doctrine\Persistence\ObjectManager */
    private $manager;

    public function load($manager)
    {
        $this->manager = $manager;
        $content = file_get_contents(self::FILE);
        $data = json_decode($content, true);

        foreach ($data as $hotelData) {
            $hotelId = new HotelId($hotelData['id']);

            $client = HotelMother::withParameters(
                $hotelId,
                new HotelName($hotelData['name']),
                new Email($hotelData['email']),
                new HotelPhone($hotelData['phone']),
                new HotelCity($hotelData['city']),
                new CountryIso($hotelData['country'])
            );

            $manager->persist($client);

            if (true === isset($hotelData['hotelRoomsData'])) {
                foreach ($hotelData['hotelRoomsData'] as $roomId) {
                    $manager->persist(
                        new HotelRoom(
                            $hotelId,
                            new RoomId($roomId)
                        )
                    );
                }
            }
        }

        $manager->flush();
    }
}
