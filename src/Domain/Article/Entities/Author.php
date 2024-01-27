<?php declare(strict_types=1);

namespace Clemento\Domain\Article\Entities;

readonly class Author
{

    public function __construct(
        public string $author,
    ) {
    }

    public function __toString(): string
    {
        return $this->author;
    }
}
