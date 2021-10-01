<?php

declare(strict_types=1);

namespace Thn\BackendTest\Infrastructure\Persistence\Doctrine;

use ReflectionException;
use ReflectionProperty;

trait PropertyHydrator
{
    /**
     * @param mixed $value
     *
     * @throws ReflectionException
     */
    protected function hydrateProperty(
        object $aggregate,
        string $propertyName,
        $value
    ): object {
        $propertyName = new ReflectionProperty(
            $aggregate,
            $propertyName
        );

        $propertyName->setAccessible(true);
        $propertyName->setValue(
            $aggregate,
            $value
        );

        return $aggregate;
    }

    protected function hydrateRelations(
        object $aggregate,
        array $includes
    ): void {
        foreach ($includes as $include) {
            if (false !== ($kebabCase = strpos($include, '-'))) {
                $include[$kebabCase + 1] = strtoupper($include[$kebabCase + 1]);
                $include = str_replace('-', '', $include);
            }

            $method = sprintf('hydrate%s', ucfirst($include));

            if (method_exists($this, $method)) {
                $this->{$method}($aggregate);
            }
        }
    }

    protected function syncRelations(
        object $aggregate,
        array $relations
    ): void {
        foreach ($relations as $relation) {
            $method = sprintf('sync%s', ucfirst($relation));

            if (method_exists($this, $method)) {
                $this->{$method}($aggregate);
            }
        }
    }
}
