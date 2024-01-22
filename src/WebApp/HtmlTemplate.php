<?php declare(strict_types=1);

namespace Clemento\WebApp;

class HtmlTemplate
{

    public const TEMPLATE_DIR = __DIR__ . '/Templates/';

    public function __construct(private string $template, private array $parameters = [])
    {
    }

    public function __toString(): string
    {
        $parameters = $this->escape($this->parameters);
        extract($parameters);
        ob_start();
	    include self::TEMPLATE_DIR . $this->template;
	    $contents = ob_get_contents();
        ob_end_clean();
        return $contents;
    }

    public static function render(string $template,  array $parameters = []): string
    {
        return (string)(new self($template, $parameters));
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
				$value = (string)$value;
	        }
            if (is_object($value)) {
                throw new \Exception("You can pass objects to a template");
            }
            $return[$key] = $value;
        }
        return $return;
    }

	private function loadTemplate(): void {
		throw new \Exception("Could not find template $this->template");
	}
}
