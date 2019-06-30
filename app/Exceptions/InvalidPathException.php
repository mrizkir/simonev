<?php
namespace App\Exceptions;
class InvalidPathException extends \InvalidArgumentException implements FilepondException {
    /**
     * @param string         $message
     * @param int            $code
     */
    public function __construct($message = 'The given file path was invalid', $code = 400) 
    {
        parent::__construct($message, $code);
    }
}