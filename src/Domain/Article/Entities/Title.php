<?php declare(strict_types=1);

namespace Clemento\Domain\Article\Entities;

readonly class Title
{

    public function __construct(
        public string $title,
    ) {
    }

    public function __toString(): string
    {
        return $this->title;
    }

}
