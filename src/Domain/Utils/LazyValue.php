<?php declare(strict_types=1);

namespace Clemento\Domain\Utils;


/**
 * @template T
 */
readonly class LazyValue
{
    private \Closure $value_calculator;

    public function __construct(callable $value_calculator)
    {
        $this->value_calculator = \Closure::fromCallable($value_calculator);
    }

    /** @return T */
    public function toValue(): mixed
    {
        $closure = $this->value_calculator;
        return $closure();
    }

}