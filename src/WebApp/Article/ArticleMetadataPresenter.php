<?php declare(strict_types=1);

namespace Clemento\WebApp\Article;

use Clemento\Domain\Article\Entities\ArticleMetadata;

readonly class ArticleMetadataPresenter
{
    public function __construct(private ArticleMetadata $article_metadata)
    {
    }

    public function toArray(): array
    {
        return [
            'title' => (string) $this->article_metadata->title,
            'created_at' => $this->article_metadata->created_at,
            'updated_at' => $this->article_metadata->updated_at,
            'id' => (string) $this->article_metadata->id,
        ];
    }
}