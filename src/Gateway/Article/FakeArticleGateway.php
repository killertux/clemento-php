<?php declare(strict_types=1);

namespace Clemento\Gateway\Article;

use Cake\Chronos\Chronos;
use Clemento\Domain\Article\Entities\Article;
use Clemento\Domain\Article\Entities\ArticleId;
use Clemento\Domain\Article\Entities\ArticleMetadata;
use Clemento\Domain\Article\Entities\ArticleMetadataCollection;
use Clemento\Domain\Article\Entities\ArticleType;
use Clemento\Domain\Article\Entities\Author;
use Clemento\Domain\Article\Entities\Body;
use Clemento\Domain\Article\Entities\Title;
use Clemento\Domain\Article\Gateways\ArticleGateway;
use EBANX\Stream\Stream;
use Override;

class FakeArticleGateway implements ArticleGateway
{

	private readonly array $articles;

	public function __construct()
	{
		$this->articles = [
			new Article(ArticleId::fromString('01HN6DDPJ0TSCSP1EZCDM5FTNJ'), ArticleType::Regular, new Author('Bruno Clemente'), new Chronos('2024-01-12 22:43:12'), new Chronos('2024-01-22 22:41:12'), new Title('Some Article'), new Body('A lot of stuff in the body')),
			new Article(ArticleId::fromString('01HN6DDPJ1P63HH9D8VM73J56N'), ArticleType::Regular, new Author('Bruno Clemente'), new Chronos('2024-01-23 22:43:12'), new Chronos('2024-01-24 22:43:12'), new Title('Another Article'), new Body('A lot of stuff in the body')),
			new Article(ArticleId::fromString('01HN6DDPJ1P63HH9D8VM73J56P'), ArticleType::Regular, new Author('Bruno Clemente'), new Chronos('2024-01-24 22:43:12'), new Chronos('2024-01-24 22:43:12'), new Title('Big Article'), new Body('A lot of stuff in the body')),
			new Article(
				ArticleId::generate(),
				ArticleType::Projects,
				new Author('Bruno Clemente'),
				new Chronos('2024-01-12 22:43:12'),
				new Chronos('2024-01-12 22:43:12'),
				new Title('Projects'),
				new Body('A detailed list of all my projects'),
			),
			new Article(
				ArticleId::generate(),
				ArticleType::About,
				new Author('Bruno Clemente'),
				new Chronos('2024-01-12 22:43:12'),
				new Chronos('2024-01-12 22:43:12'),
				new Title('About'),
				new Body('A short paragraph about myself and how to get in touch with me'),
			),
		];
	}

	#[Override] public function listArticlesMetadata(): ArticleMetadataCollection
	{
		return new ArticleMetadataCollection(
			Stream::of(array_reverse($this->articles))
				->filter(fn(Article $article) => $article->type == ArticleType::Regular)
				->map(fn(Article $article) => new ArticleMetadata($article->id, $article->created_at, $article->updated_at, $article->title))
		);
	}

	#[Override] public function getLastArticleWithType(ArticleType $article_type): ?Article
	{
		$article = Stream::of(array_reverse($this->articles))
			->filter(fn(Article $article) => $article->type == $article_type)
			->take(1)
			->collect();
		return $article ? $article[0] : null;
	}

	#[Override] public function getArticle(ArticleId $id): Article
	{
		return Stream::of($this->articles)->collectFirst(fn(Article $article) => $article->id == $id);
	}
}
