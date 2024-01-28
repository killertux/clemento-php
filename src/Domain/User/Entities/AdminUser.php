<?php declare(strict_types=1);

namespace Clemento\Domain\User\Entities;

readonly class AdminUser
{

    public function __construct(
        public User $user
    ) {
    }

}
