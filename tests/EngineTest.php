<?php

namespace Studiow\PHPTemplate\Test;

use Studiow\PHPTemplate\Engine;
use Studiow\PHPTemplate\Template;
use Studiow\PHPTemplate\Exception\FileNotFoundException;
use Studiow\PHPTemplate\Exception\FilesNotFoundException;

class EngineTest extends \PHPUnit_Framework_TestCase
{

    private function get_expected_string($header, $content, $footer)
    {
        return "[header]{$header}[/header][content]{$content}[/content][footer]{$footer}[/footer]";
    }

    public function test_template_binding()
    {
        $engine = new Engine(__DIR__ . "/res");

        $template = $engine->get("test.php", ["header" => "Header", "content" => "Content", "footer" => "Footer"]);
        $this->assertEquals((string) $template, $this->get_expected_string("Header", "Content", "Footer"));

        $template->bind("header", "Header2");
        $this->assertEquals((string) $template, $this->get_expected_string("Header2", "Content", "Footer"));

        $template->bind(["content" => "Content2", "footer" => "Footer2"]);
        $this->assertEquals((string) $template, $this->get_expected_string("Header2", "Content2", "Footer2"));
    }

    public function test_template_inheritance()
    {
        $engine = new Engine(__DIR__ . "/res", ["header" => "Header", "content" => "Content", "footer" => "Footer"]);
        $template = $engine->get("test.php");
        $this->assertEquals((string) $template, $this->get_expected_string("Header", "Content", "Footer"));
        $template->bind("header", "Header2");
        $this->assertEquals((string) $template, $this->get_expected_string("Header2", "Content", "Footer"));
    }

    public function test_template_locator()
    {
        $engine = new Engine(__DIR__ . "/res", ["header" => "Header", "content" => "Content", "footer" => "Footer"]);
        $template = $engine->find(["none_existing.php", "test.php"]);
        $this->assertEquals((string) $template, $this->get_expected_string("Header", "Content", "Footer"));
    }

    /**
     * @expectedException Studiow\PHPTemplate\Exception\FileNotFoundException
     */
    public function test_failure_file()
    {
        $engine = new Engine(__DIR__ . "/res");
        $template = $engine->get("none_existing.php");
        $template->render();
    }

    /**
     * @expectedException Studiow\PHPTemplate\Exception\FilesNotFoundException
     */
    public function test_failure_files()
    {
        $engine = new Engine(__DIR__ . "/res");
        $template = $engine->find(["none_existing.php", "none_exiting_2.php"]);
        $template->render();
    }

}
