<?php declare(strict_types=1);

namespace Tests\Clemento\WebApp;

use Clemento\WebApp\HtmlTemplate\Html;
use Clemento\WebApp\HtmlTemplate\HtmlTemplate;
use PHPUnit\Framework\TestCase;

class HtmlTemplateTest extends TestCase {

	public function testRender(): void {
		$html = new HtmlTemplate(__DIR__ . '/Templates/test_template.php', [
			'boolean' => true,
			'float' => 4.54,
			'int' => 10,
			'text' => 'Hello World',
			'text_with_html' => '<h2>Hello World</h2>',
			'html' => new Html('<h3>Another Hello World</h3>'),
			'template' => new HtmlTemplate(__DIR__ . '/Templates/test_template_2.php', ['text' => 'Hello big World'])
		]);
		$expected_output = <<<HTML
<h1>Some text</h1>
<p>1</p>
<p>4.54</p>
<p>10</p>
<p>Hello World</p>
<p>&lt;h2&gt;Hello World&lt;/h2&gt;</p>
<p><h3>Another Hello World</h3></p>

<h2>Template 2</h2>
Hello big World
HTML;
		self::assertEquals($expected_output, (string)$html);
	}
}
