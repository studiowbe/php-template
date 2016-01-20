<?php

namespace Studiow\PHPTemplate;

use Studiow\PHPTemplate\FileNotFoundException;

class Template
{

    use HasDataTrait;

    /**
     * @var string 
     */
    private $filename;

    /**
     * @var \Studiow\PHPTemplate\Engine 
     */
    private $engine;

    /**
     * Constructor
     * @param string $filename
     * @param array $data
     */
    public function __construct(Engine $engine, $filename, array $data = [])
    {
        $this->engine = $engine;
        $this->filename = $filename;
        $this->bind($data);
    }

    /**
     * Render the template
     * @return string
     * @throws FileNotFoundException
     */
    public function render()
    {
        if (!file_exists($this->filename)) {
            throw new FileNotFoundException($this->filename);
        }

        ob_start();
        extract($this->engine->getData());
        extract($this->getData());
        include $this->filename;
        return ob_get_clean();
    }

    /**
     * Cast to string
     * @return string
     */
    public function __toString()
    {
        try {
            return $this->render();
        } catch (FileNotFoundException $exc) {
            //Ignore error when casting to string
            return '';
        }
    }

    public function get($filename, $data = [])
    {
        return $this->engine->get($filename, array_merge($this->data, $data));
    }

}
