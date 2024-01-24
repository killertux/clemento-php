<?php declare(strict_types=1);

namespace Clemento\WebApp\Articles;

use Clemento\WebApp\HtmlTemplate\HtmlTemplate;
use Clemento\WebApp\HtmlTemplate\Html;
use Clemento\WebApp\HtmxUtil;
use Clemento\WebApp\Response;
use Pecee\Http\Request;

class ArticleController
{

	public function index(Request $request): Response
	{
		$articles_template = new HtmlTemplate('articles.php', [
			'article' => [
				'title' => 'Some title',
				'author' => 'Bruno Clemente',
				'body' => new Html('Some body with <b>HTML</b> text'),
				'created_at' => '2024-01-23 23:43:12',
				'updated_at' => '2024-01-24 16:25:31',
			],
			'articles_metadata' => [
				['title' => 'Some title', 'id' => 1243123123],
				['title' => 'Another title', 'id' => 2312432],
			],
		]);
		return HtmxUtil::isHtmxRequest($request) ?
			Response::html($articles_template) :
			Response::html(
				new HtmlTemplate(
					'base.php',
					['body' => $articles_template]
				)
			);
	}

	public function projects(Request $request): Response
	{
		$about_template = new HtmlTemplate('simple.php', ['body' => new Html("My <i>projects</i> page")]);
		return HtmxUtil::isHtmxRequest($request) ?
			Response::html($about_template) :
			Response::html(
				new HtmlTemplate(
					'base.php',
					['body' => $about_template]
				)
			);
	}

	public function about(Request $request): Response
	{
		$about_template = new HtmlTemplate('simple.php', ['body' => new Html("My <h2>about</h2> page")]);
		return HtmxUtil::isHtmxRequest($request) ?
			Response::html($about_template) :
			Response::html(
				new HtmlTemplate(
					'base.php',
					['body' => $about_template]
				)
			);
	}
}
