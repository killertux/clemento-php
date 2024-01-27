<?php declare(strict_types=1);

namespace Clemento\WebApp\Article;

use Clemento\Domain\Article\Entities\Article;
use Clemento\Domain\Article\Entities\ArticleMetadata;
use Clemento\Domain\Article\Entities\ArticleType;
use Clemento\Domain\Article\Gateways\ArticleGateway;
use Clemento\WebApp\HtmlTemplate\Html;
use Clemento\WebApp\HtmlTemplate\HtmlTemplate;
use Clemento\WebApp\HtmxUtil;
use Clemento\WebApp\Response;
use EBANX\Stream\Stream;
use Pecee\Http\Request;

readonly class ArticleController
{

	public function __construct(private ArticleGateway $article_gateway)
	{
	}

	public function index(Request $request): Response
	{
		$article = $this->article_gateway->getLastArticleWithType(ArticleType::Regular);
		$articles_template = new HtmlTemplate('articles.php', [
			'article_page' => new HtmlTemplate('article.php', [
				'article' => (new ArticlePresenter($article))->toArray()
			]),
			'articles_metadata' => $this->getArticleMetadataList(),
		]);
		return HtmxUtil::onHtmxRequestOrDefaultResponse(
			$request,
			$articles_template,
			new HtmlTemplate(
				'base.php',
				['body' => $articles_template]
			)
		);
	}

	public function article(Request $request, string $article_id): Response
	{
		$article_template = new HtmlTemplate('article.php', [
			'article' => (new ArticlePresenter($this->article_gateway->getArticle($article_id)))->toArray(),
		]);
		return HtmxUtil::onHtmxRequestOrDefaultResponse(
			$request,
			$article_template,
			new HtmlTemplate(
				'base.php',
				[
					'body' => new HtmlTemplate('articles.php', [
						'article_page' => $article_template,
						'articles_metadata' => $this->getArticleMetadataList(),
					])
				]
			)
		);
	}

	public function projects(Request $request): Response
	{
		return $this->simpleBodyArticleTemplate(
			$request,
			$this->article_gateway->getLastArticleWithType(ArticleType::Projects)
		);
	}

	public function about(Request $request): Response
	{
		return $this->simpleBodyArticleTemplate(
			$request,
			$this->article_gateway->getLastArticleWithType(ArticleType::About)
		);
	}

	private function simpleBodyArticleTemplate(Request $request, ?Article $projects_page): Response
	{
		$template = new HtmlTemplate(
			'simple.php',
			[
				'body' => $projects_page ? new Html((string) $projects_page->body) : null
			]
		);
		return HtmxUtil::onHtmxRequestOrDefaultResponse(
			$request,
			$template,
			new HtmlTemplate(
				'base.php',
				['body' => $template]
			)
		);
	}

	private function getArticleMetadataList(): array
	{
		return Stream::of($this->article_gateway->listArticlesMetadata())
			->map(fn(ArticleMetadata $aticle_metadata) => (new ArticleMetadataPresenter($aticle_metadata))->toArray())
			->collect();
	}
}
