<?php

namespace Studiow\PHPTemplate\Exception;

class FilesNotFoundException extends \Exception
{

    private $files;

    public function __construct(array $files, $code = 0, \Exception $previous = null)
    {
        $this->files = $files;
        $fnames = implode(', ', $files);
        parent::__construct("No file in {$fnames} could be found", $code, $previous);
    }

}
