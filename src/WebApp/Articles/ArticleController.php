<?php declare(strict_types=1);

namespace Clemento\WebApp\Articles;

use Clemento\Domain\Article\Entities\Article;
use Clemento\Domain\Article\Gateways\ArticleGateway;
use Clemento\WebApp\HtmlTemplate\Html;
use Clemento\WebApp\HtmlTemplate\HtmlTemplate;
use Clemento\WebApp\HtmxUtil;
use Clemento\WebApp\Response;
use Pecee\Http\Request;

readonly class ArticleController {

	public function __construct(private ArticleGateway $article_gateway) {
	}

	public function index(Request $request): Response {
		$article = $this->article_gateway->getLastArticle();
		$articles_template = new HtmlTemplate('articles.php', [
			'article_page' => new HtmlTemplate('article.php', [
				'article' => $this->articleToArray($article)
			]),
			'articles_metadata' => $this->article_gateway->listArticlesMetadata(),
		]);
		return HtmxUtil::onHtmxRequestOrDefaultResponse($request, $articles_template,
			new HtmlTemplate(
				'base.php',
				['body' => $articles_template]
			)
		);
	}

	private function articleToArray(?Article $article): array {
		return [
			'title' => $article->title,
			'created_at' => $article->created_at,
			'updated_at' => $article->updated_at,
			'author' => $article->author,
			'body' => $article->body,
		];
	}

	public function article(Request $request, string $article_id): Response {
		$article_template = new HtmlTemplate('article.php', [
			'article' => $this->articleToArray($this->article_gateway->getArticle($article_id))
		]);
		return HtmxUtil::onHtmxRequestOrDefaultResponse($request, $article_template,
			new HtmlTemplate(
				'base.php',
				[
					'body' => new HtmlTemplate('articles.php', [
						'article_page' => $article_template,
						'articles_metadata' => $this->article_gateway->listArticlesMetadata(),
					])
				]
			)
		);
	}

	public function projects(Request $request): Response {
		return $this->simpleBodyArticleTemplate($request, $this->article_gateway->getProjects());
	}

	private function simpleBodyArticleTemplate(Request $request, ?Article $projects_page): Response {
		$template = new HtmlTemplate('simple.php', [
				'body' => $projects_page ? new Html($projects_page->body) : null]
		);
		return HtmxUtil::onHtmxRequestOrDefaultResponse($request, $template,
			new HtmlTemplate(
				'base.php',
				['body' => $template]
			)
		);
	}

	public function about(Request $request): Response {
		return $this->simpleBodyArticleTemplate($request, $this->article_gateway->getAbout());
	}
}
