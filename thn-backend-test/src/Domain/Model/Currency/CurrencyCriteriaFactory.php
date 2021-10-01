<?php

declare(strict_types=1);

namespace Thn\BackendTest\Domain\Model\Currency;

use Thn\BackendTest\Domain\Criteria\CriteriaFactory;
use Thn\BackendTest\Domain\Criteria\Expr\Criteria;
use Thn\BackendTest\Domain\Criteria\Expr\ExpressionBuilder;
use Thn\BackendTest\Domain\Model\User\SecurityUser;

class CurrencyCriteriaFactory extends CriteriaFactory
{
    private static $fieldToSearch = [
    ];

    public function fieldToSearch(): array
    {
        return self::$fieldToSearch;
    }

    public function getUserCriteria(SecurityUser $user): Criteria
    {
        $comparison = null;
        $expressionBuilder = new ExpressionBuilder();

        return new Criteria($comparison);
    }

    public function excludeCurrency(Currency $currency): Criteria
    {
        $comparison = null;
        $expressionBuilder = new ExpressionBuilder();

        $comparison = $expressionBuilder->neq(
            'currency.id',
            $currency->id()->value()
        );

        return new Criteria($comparison);
    }
}
