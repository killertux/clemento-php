<?php

namespace Clemento\Gateway\User;

use Cake\Chronos\Chronos;
use Clemento\Domain\User\Entities\UserName;
use Clemento\Domain\User\Gateways\UserGateway;
use Clemento\Domain\User\Entities\UserId;
use Clemento\Domain\User\Entities\User;
use Clemento\Domain\User\Entities\UserRole;

class FakeUserGateway implements UserGateway {

    public function getUser(UserId $user_id): User {
        return new User(
            $user_id,
            new UserName("Bruno Clemente"),
            [UserRole::Editor],
            Chronos::now(),
            Chronos::now(),
        );
    }
}
