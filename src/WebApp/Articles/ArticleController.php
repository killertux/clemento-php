<?php declare(strict_types=1);

namespace Clemento\WebApp\Articles;

use Clemento\WebApp\HtmlTemplate;
use Clemento\WebApp\HtmxUtil;
use Clemento\WebApp\Response;
use Pecee\Http\Request;

class ArticleController {

	public function index(Request $request): Response {
		$articles_template = new HtmlTemplate('articles.php');
		return HtmxUtil::isHtmxRequest($request) ?
			Response::html($articles_template) :
			Response::html(
				new HtmlTemplate(
					'base.php',
					['body' => $articles_template]
				)
			);
	}

	public function about(Request $request): Response {
		$about_template = new HtmlTemplate('about.php');
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
