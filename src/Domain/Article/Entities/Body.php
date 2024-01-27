<?php declare(strict_types=1);

namespace Clemento\Domain\Article\Entities;

readonly class Body
{

    public function __construct(
        public string $body,
    ) {
    }

    public function __toString(): string
    {
        return $this->body;
    }

}
