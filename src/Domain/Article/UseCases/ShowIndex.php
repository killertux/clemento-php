<?php declare(strict_types=1);

namespace Clemento\Domain\Article\UseCases;

use Clemento\Domain\Article\Entities\ArticleType;
use Clemento\Domain\Article\Gateways\ArticleGateway;
use Clemento\Domain\Article\Entities\Article;
use Clemento\Domain\Article\Entities\ArticleMetadataCollection;
use Clemento\Domain\Utils\Tuple;

readonly class ShowIndex
{

    public function __construct(private ArticleGateway $article_gateway)
    {
    }

    /**
     * @return Tuple<?Article, ArticleMetadataCollection> 
     */
    public function execute(): Tuple
    {
        return new Tuple(
            $this->article_gateway->getLastArticleWithType(ArticleType::Regular),
            $this->article_gateway->listArticlesMetadata(),
        );
    }

}
