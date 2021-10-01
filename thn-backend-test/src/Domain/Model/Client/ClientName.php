<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Client;

use Thn\BackendTest\Domain\Model\Client\Exception\ClientNameInvalidMaxLength;
use Thn\BackendTest\Domain\Model\Client\Exception\ClientNameInvalidMinLength;
use Thn\BackendTest\Domain\ValueObject\StringValueObject;

class ClientName extends StringValueObject
{
    private const MAX_LENGTH = 50;

    private const MIN_LENGTH = 3;

    /**
     * @throws ClientNameInvalidMaxLength
     * @throws ClientNameInvalidMinLength
     */
    public function __construct(string $value)
    {
        parent::__construct($value);

        $lengthName = strlen($value);

        $this->checkIfMinLengthIsValid($lengthName, $value);
        $this->checkIfMaxLengthIsValid($lengthName, $value);
    }

    private function checkIfMinLengthIsValid(int $lengthName, string $name): void
    {
        if ($lengthName < self::MIN_LENGTH) {
            throw new ClientNameInvalidMinLength($name);
        }
    }

    private function checkIfMaxLengthIsValid(int $lengthName, string $name): void
    {
        if ($lengthName > self::MAX_LENGTH) {
            throw new ClientNameInvalidMaxLength($name);
        }
    }
}
