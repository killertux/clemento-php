<?php declare(strict_types=1);

namespace Clemento\Domain\Article\UseCases;

use Clemento\Domain\Article\Entities\ArticleId;
use Clemento\Domain\Article\Gateways\ArticleGateway;
use Clemento\Domain\Article\Entities\Article;
use Clemento\Domain\Article\Entities\ArticleMetadataCollection;
use Clemento\Domain\Utils\Tuple;
use Clemento\Domain\Utils\LazyValue;

readonly class ShowArticle
{

    public function __construct(private ArticleGateway $article_gateway)
    {
    }

    /**
     * @return Tuple<?Article, LazyValue<ArticleMetadataCollection>> 
     */
    public function execute(ArticleId $article_id): Tuple
    {
        return new Tuple(
            $this->article_gateway->getArticle($article_id),
            new LazyValue(fn() => $this->article_gateway->listArticlesMetadata()),
        );
    }

}
