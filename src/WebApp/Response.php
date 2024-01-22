<?php declare(strict_types=1);

namespace Clemento\WebApp;

class Response
{

    private function __construct(private string $body, private array $headers, private int $status_code)
    {
    }

    public static function text(string $text): self
    {
        return new self($text, ['Content-Type' => 'text/plain; charset=UTF-8'], 200);
    }

    public static function html(HtmlTemplate $html_template, int $status_code = 200): self
    {
        return new self((string)$html_template, ['Content-Type' => 'text/html; charset=UTF-8'], $status_code);
    }

    public function send(): void
    {
        foreach ($this->headers as $header_key => $value) {
            header("$header_key: $value", true);
        }
        http_response_code($this->status_code);
        echo $this->body;
    }
}
