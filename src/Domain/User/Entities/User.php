<?php declare(strict_types=1);

namespace Clemento\Domain\User\Entities;

use Cake\Chronos\Chronos;

readonly class User {

	/**
	 * @param UserId $id
	 * @param UserName $name
	 * @param UserRole[] $roles
	 * @param Chronos $created_at
	 * @param Chronos $updated_at
	 */
	public function __construct(
		public UserId   $id,
		public UserName $name,
		public array    $roles,
		public Chronos  $created_at,
		public Chronos  $updated_at,
	) {
	}

}
