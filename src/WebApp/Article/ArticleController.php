<?php declare(strict_types=1);

namespace Clemento\WebApp\Article;

use Clemento\Domain\Article\Entities\ArticleId;
use Clemento\Domain\Article\Entities\ArticleMetadata;
use Clemento\Domain\Article\Entities\ArticleMetadataCollection;
use Clemento\Domain\Article\Entities\Body;
use Clemento\Domain\Article\Gateways\ArticleGateway;
use Clemento\Domain\Article\UseCases\ShowAbout;
use Clemento\Domain\Article\UseCases\ShowArticle;
use Clemento\Domain\Article\UseCases\ShowIndex;
use Clemento\Domain\Article\UseCases\ShowProjects;
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
		$result = (new ShowIndex($this->article_gateway))->execute();
		$articles_template = new HtmlTemplate('articles.php', [
			'article_page' => new HtmlTemplate('article.php', [
				'article' => (new ArticlePresenter($result->a()))->toArray()
			]),
			'articles_metadata' => $this->getArticleMetadataList($result->b()),
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
		$result = (new ShowArticle($this->article_gateway))->execute(ArticleId::fromString($article_id));
		$article_template = new HtmlTemplate('article.php', [
			'article' => (new ArticlePresenter($result->a()))->toArray(),
		]);
		return HtmxUtil::onHtmxRequestOrDefaultResponse(
			$request,
			$article_template,
			new HtmlTemplate(
				'base.php',
				[
					'body' => new HtmlTemplate('articles.php', [
						'article_page' => $article_template,
						'articles_metadata' => $this->getArticleMetadataList($result->b()->toValue()),
					])
				]
			)
		);
	}

	public function projects(Request $request): Response
	{
		return $this->simpleBodyArticleTemplate(
			$request,
			(new ShowProjects($this->article_gateway))->execute()
		);
	}

	public function about(Request $request): Response
	{
		return $this->simpleBodyArticleTemplate(
			$request,
			(new ShowAbout($this->article_gateway))->execute()
		);
	}

	private function simpleBodyArticleTemplate(Request $request, ?Body $body): Response
	{
		$template = new HtmlTemplate(
			'simple.php',
			[
				'body' => $body ? new Html((string) $body) : null
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

	private function getArticleMetadataList(ArticleMetadataCollection $article_metadata_collection): array
	{
		return Stream::of($article_metadata_collection)
			->map(fn(ArticleMetadata $aticle_metadata) => (new ArticleMetadataPresenter($aticle_metadata))->toArray())
			->collect();
	}
}
