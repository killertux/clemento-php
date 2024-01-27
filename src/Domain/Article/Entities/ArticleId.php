<?php declare(strict_types=1);

namespace Clemento\Domain\Article\Entities;

use Ulid\Ulid;

readonly class ArticleId
{

    public function __construct(
        private Ulid $id,
    ) {
    }

    public static function generate(): self
    {
        return new self(Ulid::generate());
    }

    public static function fromString(string $id): self
    {
        return new self(Ulid::fromString($id));
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }

}
