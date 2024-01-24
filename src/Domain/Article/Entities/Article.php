<?php declare(strict_types=1);

namespace Clemento\Domain\Article\Entities;

class Article {

	public function __construct(
		public readonly string $author,
		public readonly string $created_at,
		public readonly string $updated_at,
		public readonly string $title,
		public readonly string $body
	) {
	}

}
