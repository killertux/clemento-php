<?php declare(strict_types=1);

namespace Clemento\Domain\Article\Entities;

use Cake\Chronos\Chronos;

readonly class ArticleMetadata
{

    public function __construct(
        public ArticleId $id,
        public Chronos $created_at,
        public Chronos $updated_at,
        public Title $title,
    ) {
    }

}
