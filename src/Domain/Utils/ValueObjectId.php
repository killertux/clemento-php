<?php declare(strict_types=1);

namespace Clemento\Domain\Utils;

use Ulid\Ulid;

readonly class ValueObjectId
{

    public function __construct(
        private Ulid $id,
    ) {
    }

    public static function generate(): static
    {
        return new static(Ulid::generate());
    }

    public static function fromString(string $id): static
    {
        return new static(Ulid::fromString($id));
    }

    public function __toString(): string
    {
        return (string) $this->id;
    }

}
