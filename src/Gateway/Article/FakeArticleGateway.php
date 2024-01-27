<?php declare(strict_types=1);

namespace Clemento\Gateway\Article;

use Clemento\Domain\Article\Entities\Article;
use Clemento\Domain\Article\Gateways\ArticleGateway;
use EBANX\Stream\Stream;
use Override;

class FakeArticleGateway implements ArticleGateway {

	private readonly array $articles;

	public function __construct() {
		$this->articles = [
			new Article('1', 'Bruno Clemente', '2024-01-12 22:43:12', '2024-01-12 22:43:12', 'Some Article', 'A lot of stuff in the body'),
			new Article('2', 'Bruno Clemente', '2024-01-23 22:43:12', '2024-01-24 22:43:12', 'Another Article', 'A lot of stuff in the body'),
			new Article('3', 'Bruno Clemente', '2024-01-24 22:43:12', '2024-01-24 22:43:12', 'Big Article', 'A lot of stuff in the body'),
		];
	}

	#[Override] public function listArticlesMetadata(): array {
		return Stream::of($this->articles)
			->map(fn(Article $article) => ['id' => $article->id, 'title' => $article->title])
			->collect();
	}

	#[Override] public function getLastArticle(): ?Article {
		return $this->articles[count($this->articles) - 1];
	}

	#[Override] public function getArticle(string $id): Article {
		return Stream::of($this->articles)->collectFirst(fn(Article $article) => $article->id == $id);
	}

	#[Override] public function getProjects(): ?Article {
		return new Article(
			'5',
			'Bruno Clemente',
			'2024-01-12 22:43:12',
			'2024-01-12 22:43:12',
			'Projects',
			'A detailed list of all my projects'
		);
	}

	#[Override] public function getAbout(): ?Article {
		return new Article(
			'5',
			'Bruno Clemente',
			'2024-01-12 22:43:12',
			'2024-01-12 22:43:12',
			'About',
			'A short paragraph about myself and how to get in touch with me'
		);
	}
}
