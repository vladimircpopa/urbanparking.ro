<?php

namespace ApiBundle\Listener;

use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use ApiBundle\Exception\InputValidationException;
use Doctrine\DBAL\Exception\NotNullConstraintViolationException;
use Symfony\Component\Security\Core\Exception\AuthenticationCredentialsNotFoundException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @author Samuel Chiriluta <samuel.chiriluta@orange.com>
 */
class ApiExceptionListener {

    const API_PATH_PREFIX = '/api/';
    const DEFAULT_EXCEPTION_MESSAGE = 'Internal server error!!';

    /**
     * @var \Symfony\Bridge\Monolog\Logger
     */
    private $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Handles security related exceptions.
     *
     * @param GetResponseForExceptionEvent $event An GetResponseForExceptionEvent instance
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $request = $event->getRequest();

        // We treat here just /api/* route exceptions 
        if (0 !== strpos($request->getPathInfo(), self::API_PATH_PREFIX))
        {
            return;
        }

        $exception = $event->getException();

        if ($exception instanceof InputValidationException)
        {
            $responseData = array(
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $exception->getMessage(),
            );
        }
        elseif ($exception instanceof BadRequestHttpException)
        {
            $responseData = array(
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $exception->getMessage(),
            );
        }
        elseif ($exception instanceof NotNullConstraintViolationException)
        {
            $responseData = array(
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => 'Null or invalid request content',
            );
        }
        elseif ($exception instanceof AuthenticationCredentialsNotFoundException)
        {
            $responseData = array(
                'code' => Response::HTTP_UNAUTHORIZED,
                'message' => $exception->getMessage(),
            );
        }
        elseif ($exception instanceof AccessDeniedException)
        {
            $responseData = array(
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
            );
        }
        else
        {
            $statusCode = $exception->getCode();

            if (!array_key_exists($statusCode, Response::$statusTexts))
            {
                $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;
            }

            $responseData = array(
                'code' => $statusCode,
                'message' => self::DEFAULT_EXCEPTION_MESSAGE,
            );
        }
        
        if (isset($responseData))
        {
            $exceptionContext = array_merge($responseData, [
                'pathInfo' => $request->getPathInfo(),
                'exceptionMessage' => $exception->getMessage()
            ]);

            $this->logger->debug("API Exception Listener", $exceptionContext);

            $response = new JsonResponse($responseData, $responseData['code']);

            $event->setResponse($response);
        }
    }

}
