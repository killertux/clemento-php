<?php declare(strict_types=1);

namespace Clemento\Domain\Article\UseCases;

use Clemento\Domain\Article\Entities\Body;
use Clemento\Domain\Article\Gateways\ArticleGateway;
use Clemento\Domain\Article\Entities\ArticleType;

readonly class ShowProjects
{

    public function __construct(private ArticleGateway $article_gateway)
    {
    }

    public function execute(): ?Body
    {
        return $this->article_gateway->getLastArticleWithType(ArticleType::Projects)?->body;
    }

}
