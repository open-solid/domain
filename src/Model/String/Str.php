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

namespace OpenSolid\Domain\Model\String;

use Symfony\Component\String\UnicodeString;

class Str extends UnicodeString
{
    public static function from(string $value): static
    {
        return new static($value);
    }

    public function value(): string
    {
        return $this->string;
    }

    final public function __construct(string $value = '')
    {
        parent::__construct($value);
    }
}
