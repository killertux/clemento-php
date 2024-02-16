<?php declare(strict_types=1);

namespace Clemento\WebApp;

use Clemento\Domain\Article\Gateways\ArticleGateway;
use Clemento\Domain\User\Gateways\UserGateway;
use Clemento\Gateway\Article\FakeArticleGateway;
use Clemento\Gateway\User\FakeUserGateway;
use Clemento\WebApp\Article\ArticleController;
use Pecee\SimpleRouter\SimpleRouter;

readonly class WebbApp {
	private ArticleGateway $article_gateway;
	private UserGateway $user_gateway;

	public function __construct(ArticleGateway $article_gateway = null, UserGateway $user_gateway = null) {
		$this->article_gateway = $article_gateway ?? new FakeArticleGateway();
		$this->user_gateway = $user_gateway ?? new FakeUserGateway();
	}

	public function run(): void {
		$request = SimpleRouter::request();
		$article_controller = new ArticleController($this->article_gateway);
		SimpleRouter::get("/", fn() => $article_controller->index($request)->send());
		SimpleRouter::get("/article/{id}", fn(string $id) => $article_controller->article($request, $id)->send());
		SimpleRouter::get("/about", fn() => $article_controller->about($request)->send());
		SimpleRouter::get("/projects", fn() => $article_controller->projects($request)->send());
		SimpleRouter::start();
	}

}
