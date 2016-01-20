<?php

namespace Studiow\PHPTemplate;

class FilesNotFoundException extends \Exception
{

    private $files;

    public function __construct(array $files)
    {
        $this->files = files;
        $fnames = implode(', ', $files);
        parent::__construct("No file in {$fnames} could be found", $code, $previous);
    }

}
