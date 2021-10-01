<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Persistence\Doctrine\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Thn\BackendTest\Infrastructure\Persistence\Doctrine\PropertyHydrator;

class DoctrineRepository
{
    use PropertyHydrator;

    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var ObjectRepository */
    protected $repository;

    public function __construct(EntityManagerInterface $entityManager, string $entityClass)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository($entityClass);
    }

    protected function doSave($entity)
    {
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
    }
}
