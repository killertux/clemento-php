<?php

namespace Clemento\Domain\User\Gateways;

use Clemento\Domain\User\Entities\User;
use Clemento\Domain\User\Entities\UserId;

interface UserGateway {

	public function getUser(UserId $user_id): User;
}
