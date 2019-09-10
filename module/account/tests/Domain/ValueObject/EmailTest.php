<?php

/**
 * Copyright © Bold Brand Commerce Sp. z o.o. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types = 1);

namespace Ergonode\Account\Tests\Domain\ValueObject;

use Ergonode\Account\Domain\ValueObject\Email;
use PHPUnit\Framework\TestCase;

/**
 */
class EmailTest extends TestCase
{
    /**
     * @param string $value
     *
     * @dataProvider validDataProvider
     */
    public function testValidaValue(string $value): void
    {
        $email = new Email($value);
        $this->assertEquals($value, $email->getValue());
        $this->assertEquals($value, (string) $email);
    }

    /**
     * @return array
     */
    public function validDataProvider(): array
    {
        return [
            ['correct@email.com'],
            ['correct.email@email.com'],
            ['correct+email@email.com.com'],
            ['c@c.c'],
            ['some.long+address-without-sense@because.i.can'],
            ['correct@domain'],
        ];
    }

    /**
     * @param string
     *
     * @expectedException \InvalidArgumentException
     *
     * @dataProvider invalidDataProvider
     */
    public function testInvalidValue(string $value): void
    {
        new Email($value);
    }

    /**
     * @return array
     */
    public function invalidDataProvider(): array
    {
        return [
            [''],
            ['incorrect'],
            ['incorr ect@email.com'],
            ['forgot.monkey.com'],
        ];
    }

    /**
     * @param string $input
     * @param string $expected
     *
     * @dataProvider formatDataProvider
     */
    public function testFormat(string $input, string $expected): void
    {
        $email = new Email($input);

        $this->assertEquals($expected, $email->getValue());
    }

    /**
     * @return array
     */
    public function formatDataProvider(): array
    {
        return [
            [
                'BIG@EMAIL.COM',
                'big@email.com',
            ],
            [
                'Óąść@email.com',
                'óąść@email.com',
            ],
            [
                ' withspaces@email.com ',
                'withspaces@email.com',
            ],
        ];
    }
}