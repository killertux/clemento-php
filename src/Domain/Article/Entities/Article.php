<?php declare(strict_types=1);

namespace Clemento\Domain\Article\Entities;

use Cake\Chronos\Chronos;

readonly class Article
{

	public function __construct(
		public ArticleId $id,
		public Author $author,
		public Chronos $created_at,
		public Chronos $updated_at,
		public Title $title,
		public Body $body
	) {
	}

}
