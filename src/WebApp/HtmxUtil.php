<?php declare(strict_types=1);

namespace Clemento\WebApp;

use Pecee\Http\Request;

class HtmxUtil {

	public static function isHtmxRequest(Request $request): bool {
		return $request->getHeader('HX-Request', 'false') === 'true';
	}
}
