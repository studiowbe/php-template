<?php

namespace Studiow\PHPTemplate\Exception;

class FileNotFoundException extends \Exception
{

    public function __construct($filename, $code = 0, \Exception $previous = null)
    {
        parent::__construct("File {$filename} not found", $code, $previous);
    }

}
