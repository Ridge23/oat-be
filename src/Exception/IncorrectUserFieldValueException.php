<?php

namespace App\Exception;

use Exception;

class IncorrectUserFieldValueException extends Exception
{
    protected $message = 'Field value is incorrect. Check data source';
}
