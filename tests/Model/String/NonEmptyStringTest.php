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

namespace OpenSolid\Domain\Tests\Model\String;

use OpenSolid\Domain\Error\InvariantViolation;
use OpenSolid\Domain\Model\String\NonEmptyString;
use PHPUnit\Framework\TestCase;

class NonEmptyStringTest extends TestCase
{
    public function testEmptyError(): void
    {
        $this->expectException(InvariantViolation::class);
        $this->expectExceptionMessage('String cannot be empty.');

        NonEmptyString::from('');
    }

    public function testEmptyWithBlankSpacesError(): void
    {
        $this->expectException(InvariantViolation::class);
        $this->expectExceptionMessage('String cannot be empty.');

        NonEmptyString::from('   ');
    }

    public function testTrimString(): void
    {
        $this->assertSame('A', NonEmptyString::from(' A ')->value());
    }
}
