<?php

declare(strict_types=1);

/*
 * This file is part of OpenSolid package.
 *
 * (c) Yonel Ceruto <open@yceruto.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace OpenSolid\Domain\Tests\Model\Integer;

use OpenSolid\Domain\Error\InvariantViolation;
use OpenSolid\Domain\Model\Integer\PositiveInteger;
use PHPUnit\Framework\TestCase;

class PositiveIntegerTest extends TestCase
{
    public function testPositiveInteger(): void
    {
        $i = PositiveInteger::from(1);

        $this->assertSame(1, $i->value());
    }

    public function testNegativeInteger(): void
    {
        $this->expectException(InvariantViolation::class);
        $this->expectExceptionMessage('Value must be positive.');

        PositiveInteger::from(-1);
    }
}
