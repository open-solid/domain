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

namespace OpenSolid\Domain\Error\Store;

use OpenSolid\Domain\Error\DomainError;

trait InMemoryErrorStoreTrait
{
    /**
     * @var array<DomainError>
     */
    private array $errors = [];

    final protected function pushDomainError(string|DomainError $error): void
    {
        $this->errors[] = is_string($error) ? DomainError::create($error) : $error;
    }

    final protected function throwDomainErrors(): void
    {
        if ([] === $this->errors) {
            return;
        }

        if (1 === count($this->errors)) {
            throw $this->errors[0];
        }

        $errors = [];
        foreach ($this->errors as $error) {
            $errors[$error::class] = $error::class;
        }

        if (1 === count($errors)) {
            throw $this->errors[0]::createMany($this->errors);
        }

        throw DomainError::createMany($this->errors);
    }
}
