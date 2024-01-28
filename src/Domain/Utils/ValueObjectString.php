<?php declare(strict_types=1);

namespace Clemento\Domain\Utils;

readonly class ValueObjectString
{

    public function __construct(
        public string $value,
    ) {
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
