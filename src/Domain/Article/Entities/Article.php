<?php declare(strict_types=1);

namespace Clemento\Domain\Article\Entities;

readonly class Article {

	public function __construct(
		public string $id,
		public string $author,
		public string $created_at,
		public string $updated_at,
		public string $title,
		public string $body
	) {
	}

}
