<?php

namespace App\Exceptions;

use Exception;

class RecordNotFound extends Exception
{
    public function __construct($message='',$id)
    {
        parent::__construct($message.$id);
    }
}
