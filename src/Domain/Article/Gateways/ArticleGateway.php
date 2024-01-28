<?php declare(strict_types=1);

namespace Clemento\Domain\Article\Gateways;

use Clemento\Domain\Article\Entities\Article;
use Clemento\Domain\Article\Entities\ArticleId;
use Clemento\Domain\Article\Entities\ArticleMetadataCollection;
use Clemento\Domain\Article\Entities\ArticleType;

interface ArticleGateway
{
    public function listArticlesMetadata(): ArticleMetadataCollection;
    public function getLastArticleWithType(ArticleType $article_type): ?Article;
    public function getArticle(ArticleId $id): Article;

}