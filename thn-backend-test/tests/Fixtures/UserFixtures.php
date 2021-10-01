<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Fixtures;

use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Thn\BackendTest\Domain\Model\Email\Email;
use Thn\BackendTest\Domain\Model\User\PasswordEncoder;
use Thn\BackendTest\Domain\Model\User\UserId;
use Thn\BackendTest\Domain\Model\User\UserName;
use Thn\BackendTest\Domain\Model\User\UserPassword;
use Thn\BackendTest\Domain\Model\User\UserRole;
use Thn\BackendTest\Tests\Unit\Domain\Model\User\UserMother;

class UserFixtures implements ORMFixtureInterface
{
    private const FILE = 'tests/Fixtures/data/users.json';

    /** @var PasswordEncoder */
    private $passwordEncoder;

    public function __construct(
        PasswordEncoder $passwordEncoder
    ) {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load($manager)
    {
        $content = file_get_contents(self::FILE);

        $data = json_decode($content, true);

        foreach ($data as $userData) {
            $userId = new UserId($userData['id']);

            $user = UserMother::withParameters(
                $userId,
                new UserName($userData['name']),
                new Email($userData['email']),
                new UserPassword($this->passwordEncoder->encode('password')),
                new UserRole($userData['role'])
            );

            $manager->persist($user);
        }

        $manager->flush();
    }
}
