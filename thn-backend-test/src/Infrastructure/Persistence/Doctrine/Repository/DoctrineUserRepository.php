<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Thn\BackendTest\Domain\Model\Email\Email;
use Thn\BackendTest\Domain\Model\SecurityUser\SecurityUser;
use Thn\BackendTest\Domain\Model\SecurityUser\SecurityUserRepository;
use Thn\BackendTest\Domain\Model\User\User;
use Thn\BackendTest\Domain\Model\User\UserId;
use Thn\BackendTest\Domain\Model\User\UserRepository;
use Thn\BackendTest\Infrastructure\Persistence\Doctrine\PropertyHydrator;

class DoctrineUserRepository extends DoctrineRepository implements UserRepository, SecurityUserRepository
{
    use PropertyHydrator;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, User::class);
    }

    public function byEmail(Email $userEmail): ?User
    {
        /** @var User $user */
        $user = $this->repository->findOneBy(
            [
                'email.value' => $userEmail->value(),
            ]
        );

        return $user;
    }

    public function save(User $user, ?array $relations = null): void
    {
        $this->entityManager->persist($user);
    }

    public function securityUserById(UserId $id): ?SecurityUser
    {
        return $this->byId($id);
    }

    public function byId(UserId $userId): ?User
    {
        /** @var null|User $user */
        $user = $this->repository->findOneBy(
            [
                'id' => $userId,
            ]
        );

        return $user;
    }

    public function count(): int
    {
        return (int) $this->repository->createQueryBuilder('user')
            ->select('count(distinct(user))')
            ->where('user.deleted = 0')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }
}
