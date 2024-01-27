<?php declare(strict_types=1);

namespace Test\Clemento\WebApp\Articles;

use Cake\Chronos\Chronos;
use Clemento\Domain\Article\Entities\Article;
use Clemento\Domain\Article\Entities\ArticleId;
use Clemento\Domain\Article\Entities\ArticleType;
use Clemento\Domain\Article\Entities\Author;
use Clemento\Domain\Article\Entities\Body;
use Clemento\Domain\Article\Entities\Title;
use Clemento\WebApp\Article\ArticlePresenter;
use Clemento\WebApp\HtmlTemplate\Html;
use PHPUnit\Framework\TestCase;

class ArticlePresenterTest extends TestCase
{

    public function testToArray(): void
    {
        $article = new Article(
            ArticleId::generate(),
            ArticleType::Regular,
            new Author('Bruno Clemente'),
            new Chronos('2024-01-12 22:43:12'),
            new Chronos('2024-01-12 22:43:12'),
            new Title('Some Article'),
            new Body('A lot of stuff in the body')
        );
        self::assertEquals(
            [
                'title' => 'Some Article',
                'created_at' => '2024-01-12 22:43:12',
                'updated_at' => '2024-01-12 22:43:12',
                'author' => 'Bruno Clemente',
                'body' => new Html('A lot of stuff in the body'),
            ],
            (new ArticlePresenter($article))->toArray()
        );
    }
}