<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Attribute\Domain\Command\Attribute\Update;

use Ergonode\Attribute\Domain\Command\Attribute\AbstractUpdateAttributeCommand;
use Ergonode\Core\Domain\ValueObject\TranslatableString;
use Ergonode\SharedKernel\Domain\Aggregate\AttributeId;
use Money\Currency;
use Ergonode\Attribute\Domain\ValueObject\AttributeScope;

/**
 */
class UpdatePriceAttributeCommand extends AbstractUpdateAttributeCommand
{
    /**
     * @var Currency
     *
     * @JMS\Type("Money\Currency")
     */
    private Currency $currency;

    /**
     * @param AttributeId        $id
     * @param TranslatableString $label
     * @param TranslatableString $hint
     * @param TranslatableString $placeholder
     * @param AttributeScope     $scope
     * @param Currency           $currency
     * @param array              $groups
     */
    public function __construct(
        AttributeId $id,
        TranslatableString $label,
        TranslatableString $hint,
        TranslatableString $placeholder,
        AttributeScope $scope,
        Currency $currency,
        array $groups = []
    ) {
        parent::__construct(
            $id,
            $label,
            $hint,
            $placeholder,
            $scope,
            $groups
        );

        $this->currency = $currency;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }
}