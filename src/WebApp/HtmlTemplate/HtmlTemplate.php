<?php declare(strict_types=1);

namespace Clemento\WebApp\HtmlTemplate;

use Cake\Chronos\Chronos;
use Cake\Chronos\ChronosDate;
use Exception;

class HtmlTemplate
{

	public const TEMPLATE_DIR = __DIR__ . '/../Templates/';

	public function __construct(private readonly string $template, private readonly array $parameters = [])
	{
	}

	public function render(): string
	{
		return $this->__toString();
	}

	public function __toString(): string
	{
		$parameters = $this->escape($this->parameters);
		extract($parameters);
		ob_start();
		if (file_exists(self::TEMPLATE_DIR . $this->template)) {
			include self::TEMPLATE_DIR . $this->template;
		} else {
			include $this->template;
		}
		return ob_get_clean();
	}

	public function escape(array $parameters): array
	{
		$return = [];
		foreach ($parameters as $key => $value) {
			if (is_string($value)) {
				$value = htmlentities($value);
			}
			if (is_array($value)) {
				$value = $this->escape($value);
			}
			if ($value instanceof HtmlTemplate) {
				$value = (string) $value;
			}
			if ($value instanceof Html) {
				$value = $value->html;
			}
			if (is_object($value) && !($value instanceof Chronos || $value instanceof ChronosDate)) {
				throw new Exception("You cannot pass objects to a template");
			}

			$return[$key] = $value;
		}
		return $return;
	}
}
