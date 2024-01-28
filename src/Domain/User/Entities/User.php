<?php declare(strict_types=1);

namespace Clemento\Domain\User\Entities;

use Cake\Chronos\Chronos;

readonly class User
{

    public function __construct(
        public UserId $id,
        public UserName $name,
        public Chronos $created_at,
        public Chronos $updated_at,
    ) {
    }

}
