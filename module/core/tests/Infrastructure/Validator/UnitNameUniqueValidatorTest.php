<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Core\Tests\Infrastructure\Validator;

use Ergonode\Core\Domain\Query\UnitQueryInterface;
use Ergonode\Core\Infrastructure\Validator\Constraint\UnitNameUnique;
use Ergonode\Core\Infrastructure\Validator\UnitNameUniqueValidator;
use Ergonode\SharedKernel\Domain\Aggregate\UnitId;
use PHPUnit\Framework\MockObject\MockObject;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

/**
 */
class UnitNameUniqueValidatorTest extends ConstraintValidatorTestCase
{
    /**
     * @var UnitQueryInterface|MockObject
     */
    private UnitQueryInterface $query;

    /**
     */
    protected function setUp(): void
    {
        $this->query = $this->createMock(UnitQueryInterface::class);
        parent::setUp();
    }

    /**
     */
    public function testWrongValueProvided(): void
    {
        $this->expectException(\Symfony\Component\Validator\Exception\ValidatorException::class);
        $this->validator->validate(new \stdClass(), new UnitNameUnique());
    }

    /**
     */
    public function testWrongConstraintProvided(): void
    {
        $this->expectException(\Symfony\Component\Validator\Exception\ValidatorException::class);
        /** @var Constraint $constraint */
        $constraint = $this->createMock(Constraint::class);
        $this->validator->validate('Value', $constraint);
    }

    /**
     */
    public function testCorrectEmptyValidation(): void
    {
        $this->validator->validate('', new UnitNameUnique());

        $this->assertNoViolation();
    }

    /**
     */
    public function testCorrectRaisedValidation(): void
    {
        $this->query->method('findIdByName')->willReturn($this->createMock(UnitId::class));
        $constraint = new UnitNameUnique();
        $value = 'value';
        $this->validator->validate($value, $constraint);

        $assertion = $this->buildViolation($constraint->uniqueMessage);
        $assertion->assertRaised();
    }

    /**
     * @return UnitNameUniqueValidator
     */
    protected function createValidator(): UnitNameUniqueValidator
    {
        return new UnitNameUniqueValidator($this->query);
    }
}