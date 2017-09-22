<?php

namespace ApiBundle\Exception;

use Symfony\Component\HttpFoundation\Response;

/**
 * @author Samuel Chiriluta <samuel.chiriluta@orange.com>
 */
class InputValidationException extends \Exception {

    public function __construct($message, $code = Response::HTTP_BAD_REQUEST, \Exception $previous = null)
    {
        parent::__construct('Input validation error: ' . $message, $code, $previous);
    }

}
