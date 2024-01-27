<?php declare(strict_types=1);

namespace Clemento\Domain\Article\Entities;

use Override;

class ArticleMetadataCollection extends \IteratorIterator
{

    #[Override] public function current(): ArticleMetadata
    {
        return parent::current();
    }

}
