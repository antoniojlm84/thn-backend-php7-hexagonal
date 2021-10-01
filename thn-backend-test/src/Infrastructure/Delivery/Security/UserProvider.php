<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Delivery\Security;

use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Thn\BackendTest\Domain\Model\User\User;
use Thn\BackendTest\Domain\Model\User\UserRepository;

class UserProvider implements UserProviderInterface
{
    /** @var UserRepository  */
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function loadUserByUsername($data): User
    {
        $userData  = $this->userRepository->byEmail($data[0]);

        if ($userData) {
            return $userData;
        }

        throw new UserNotFoundException(
            sprintf('Username "%s" does not exist.', $data[0])
        );
    }

    public function refreshUser(UserInterface $user): User
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->email());
    }

    public function supportsClass($class):bool
    {
        return User::class === $class;
    }
}