<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Email;

use Thn\BackendTest\Domain\Exception\EmailNotValid;
use Thn\BackendTest\Domain\Validation\Assert;
use Thn\BackendTest\Domain\ValueObject\StringValueObject;

class Email extends StringValueObject
{
    /**
     * @throws EmailNotValid
     */
    public function __construct(string $value)
    {
        $email = strtolower($value);
        $this->validateEmail($email);

        parent::__construct($email);
    }

    /**
     * @throws EmailNotValid
     */
    private function validateEmail(string $email): void
    {
        if (Assert::isEmail($email)) {
            throw new EmailNotValid($email);
        }
    }
}
