<?php

namespace Studiow\PHPTemplate;

class Engine
{

    use HasDataTrait;

    private $base_dir;

    /**
     * Constructor
     * @param string $base_dir
     * @param array $data
     */
    public function __construct($base_dir, array $data = [])
    {
        $this->base_dir = realpath($base_dir);
        $this->bind($data);
    }

    /**
     * Convert filename to full path
     * @param string $filename
     * @return string
     */
    private function parseFilename($filename)
    {
        return $this->base_dir . '/' . ltrim($filename, '/');
    }

    /**
     * Create a new template
     * @param string $filename
     * @param array $data
     * @return \Studiow\PHPTemplate\Template
     */
    public function get($filename, array $data = [])
    {
        $template = new Template(
                $this, $this->parseFilename($filename), $data
        );
        return $template;
    }

    public function find(array $filenames, array $data = [])
    {

        foreach ($filenames as $filename) {
            if (file_exists($this->parseFilename($filename))) {
                return $this->get($filename, $data);
            }
        }
    }

}
