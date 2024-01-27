<?php declare(strict_types=1);

namespace Clemento\WebApp;

use Clemento\WebApp\HtmlTemplate\HtmlTemplate;
use Pecee\Http\Request;

readonly class HtmxUtil {

	public static function onHtmxRequestOrDefaultResponse(Request $request, HtmlTemplate $on_htmx_request, HtmlTemplate $default): Response {
		return Response::html(self::isHtmxRequest($request) ? $on_htmx_request : $default);
	}

	public static function isHtmxRequest(Request $request): bool {
		return $request->getHeader('HX-Request', 'false') === 'true';
	}
}
