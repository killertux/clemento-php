<?php declare(strict_types=1);

namespace Clemento\WebApp\Articles;

use Clemento\WebApp\HtmlTemplate;
use Clemento\WebApp\Response;
use Pecee\Http\Request;

class ArticleController
{

    public function index(): Response
    {
        return Response::html(
			new HtmlTemplate(
				'base.php',
				['body' => new HtmlTemplate('index.php')]
			)
        );
    }
}
