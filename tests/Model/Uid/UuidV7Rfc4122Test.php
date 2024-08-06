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

namespace OpenSolid\Domain\Tests\Model\Uid;

use OpenSolid\Domain\Error\InvariantViolation;
use OpenSolid\Domain\Model\Uid\UuidV7Rfc4122;
use PHPUnit\Framework\TestCase;

class UuidV7Rfc4122Test extends TestCase
{
    public function testCreate(): void
    {
        $id = UuidV7Rfc4122::create();

        $this->assertSame(36, strlen($id->value()));
    }

    public function testCreateFromString(): void
    {
        $id = UuidV7Rfc4122::from('f81d4fae-7dec-11d0-a765-00a0c91e6bf6');

        $this->assertSame(36, strlen($id->value()));
        $this->assertSame('f81d4fae-7dec-11d0-a765-00a0c91e6bf6', $id->value());
    }

    public function testCreateFromStringInvalid(): void
    {
        $this->expectException(InvariantViolation::class);
        $this->expectExceptionMessage('Invalid UUID: "f81d4fae".');

        UuidV7Rfc4122::from('f81d4fae');
    }

    public function testEquals(): void
    {
        $id1 = UuidV7Rfc4122::from('f81d4fae-7dec-11d0-a765-00a0c91e6bf6');
        $id2 = UuidV7Rfc4122::from('f81d4fae-7dec-11d0-a765-00a0c91e6bf6');
        $id3 = UuidV7Rfc4122::from('f81d4fae-7dec-11d0-a765-00a0c91e6bf7');

        $this->assertTrue($id1->equals($id2));
        $this->assertFalse($id1->equals($id3));
    }

    public function testToString(): void
    {
        $id = UuidV7Rfc4122::from('f81d4fae-7dec-11d0-a765-00a0c91e6bf6');

        $this->assertSame('f81d4fae-7dec-11d0-a765-00a0c91e6bf6', (string) $id);
    }
}
