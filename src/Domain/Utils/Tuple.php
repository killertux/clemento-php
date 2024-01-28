<?php declare(strict_types=1);

namespace Clemento\Domain\Utils;


/**
 * @template A
 * @template B
 */
class Tuple
{
    /**
     * @param A $a
     * @param B $b
     */
    public function __construct(private $a, private $b)
    {
    }

    /** @return A */
    public function a(): mixed
    {
        return $this->a;
    }

    /** @return B */
    public function b(): mixed
    {
        return $this->b;
    }

}