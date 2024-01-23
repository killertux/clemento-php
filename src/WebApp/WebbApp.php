<?php declare(strict_types=1);

namespace Clemento\WebApp;

use Clemento\WebApp\Articles\ArticleController;
use Pecee\SimpleRouter\SimpleRouter;

class WebbApp {

	public function __construct() {
	}

	public function run(): void {
		$request = SimpleRouter::request();
		$article_controller = new ArticleController();
		SimpleRouter::get("/", fn() => $article_controller->index($request)->send());
		SimpleRouter::get("/about", fn() => $article_controller->about($request)->send());
		SimpleRouter::start();
	}

}
