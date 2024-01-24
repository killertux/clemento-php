<?php declare(strict_types=1);

namespace Clemento\Domain\Article\Gateways;

use Clemento\Domain\Article\Entities\Article;

interface ArticleGateway
{
    public function listArticlesMetadata(): array;
    public function getLastArticle(): ?Article;
    public function getArticle(string $id): Article;
    public function getProjects(): ?Article;
    public function getAbout(): ?Article;
}