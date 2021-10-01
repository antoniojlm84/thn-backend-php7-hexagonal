<?php

declare(strict_types=1);

namespace Thn\BackendTest\Tests\Unit\Domain\Model;

use ReflectionClass;
use Thn\BackendTest\Domain\Collection\AbstractCollection;

class Mother
{
    protected static function setProperties(ReflectionClass $reflectionClass, &$aInstance, array $data)
    {
        foreach ($reflectionClass->getProperties() as $property) {
            if (true === isset($data[$property->getName()])) {
                $property->setAccessible(true);
                $property->setValue($aInstance, $data[$property->getName()]);
            }
        }
    }

    protected static function generateDataArray(
        array $fields,
        ReflectionClass $reflectionClass,
        array $fieldMapping,
        bool $isCommand = false
    ): array {
        $data = [];

        foreach ($reflectionClass->getProperties() as $property) {
            $value = null;
            if (true === isset($fields[$property->getName()])) {
                $data[$property->getName()] = $fields[$property->getName()];
            } else {
                if (isset($fieldMapping[$property->getName()])) {
                    $generator = $fieldMapping[$property->getName()];
                    $generatorClass = $generator['generator'];
                    $randomInstance = $generatorClass::random();

                    if (isset($generator['functions'])) {
                        foreach ($generator['functions'] as $function) {
                            if (isset($function['arguments'])) {
                                $randomInstance = $randomInstance->{$function['name']}($function['arguments']);
                            } else {
                                $randomInstance = $randomInstance->{$function['name']}();
                            }
                        }

                        $value = $randomInstance;
                    } elseif ($randomInstance instanceof AbstractCollection || !$isCommand) {
                        $value = $randomInstance;
                    } else {
                        $value = $randomInstance->value();
                    }
                }

                $data[$property->getName()] = $value;
            }
        }

        return $data;
    }
}
