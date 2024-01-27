<?php declare(strict_types=1);

namespace Clemento\WebApp\Article;

use Clemento\Domain\Article\Entities\Article;
use Clemento\WebApp\HtmlTemplate\Html;

readonly class ArticlePresenter
{
    public function __construct(private Article $article)
    {
    }

    public function toArray(): array
    {
        return [
            'title' => (string) $this->article->title,
            'created_at' => $this->article->created_at,
            'updated_at' => $this->article->updated_at,
            'author' => (string) $this->article->author,
            'body' => new Html((string) $this->article->body),
        ];
    }
}