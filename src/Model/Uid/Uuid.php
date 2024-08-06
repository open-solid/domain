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

namespace OpenSolid\Domain\Model\Uid;

abstract readonly class Uuid implements \Stringable
{
    abstract public static function create(): static;

    abstract public static function from(string $value): static;

    abstract public static function generate(): string;

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value() === $other->value();
    }

    public function __toString(): string
    {
        return $this->value();
    }

    final protected function __construct(
        protected string $value,
    ) {
    }
}
