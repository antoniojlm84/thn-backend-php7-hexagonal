<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Currency;

use Thn\BackendTest\Domain\Model\Currency\Exception\CurrencyNotFound;

class CurrencyValidation
{
    /** @var CurrencyRepository */
    private $currencyRepository;

    public function __construct(
        CurrencyRepository $currencyRepository
    ) {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * @throws CurrencyNotFound
     */
    public function checkCurrency(string $id): CurrencyId
    {
        $currencyId = new CurrencyId($id);
        if (null === $this->currencyRepository->byId($currencyId)) {
            throw new CurrencyNotFound($currencyId);
        }

        return $currencyId;
    }
}
