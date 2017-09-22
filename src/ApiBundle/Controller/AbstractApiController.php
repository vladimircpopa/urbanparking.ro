<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\Form\Form;
use FOS\RestBundle\Controller\Annotations\QueryParam; 

class AbstractApiController extends FOSRestController {

    protected function getFriendlyFormErrors(Form $form, $stringFormat = true)
    {
        $errors = $form->getErrors(true);
        $fiendlyErrors = array();

        foreach ($errors as $error)
        {
            $path = $error->getCause()->getPropertyPath();
            $friendlyPath = $this->getFriendlyPath($path);

            $fiendlyErrors[$friendlyPath][] = $error->getMessage();
        }

        if ($stringFormat)
        {
            $fiendlyErrors = $this->getErrorsAsString($fiendlyErrors);
        }

        return $fiendlyErrors;
    }

    private function getFriendlyPath($path)
    {
        return str_replace(['data.', 'children[', ']'], [''], $path);
    }

    private function getErrorsAsString(array $errors)
    {
        if (empty($errors))
        {
            return null;
        }

        $stringResult = array();

        foreach ($errors as $path => $message)
        {
            $stringResult[] = '`' . $path . '` - ' . implode("; `" . $path . "` - ", $message);
        }

        return implode("; ", $stringResult);
    }

    protected function getEntityManager()
    {
        return $this->getDoctrine()->getManager();
    }

    protected function getRepository()
    {
        return $this->getEntityManager()->getRepository(static::ENTITY_PATH);
    }

    protected function generatePaginationHeaders(ParamFetcher $paramFetcher, $resultCount = 0)
    {
        $headers = [
            'X-Offset' => $paramFetcher->get('offset'),
            'X-Limit' => $paramFetcher->get('limit'),
            'X-Result-Count' => $resultCount,
            'X-Total-Count' => $this->getRepository()->count($paramFetcher),
        ];
        
        return $headers;
    }
    
    protected function addParamFetcher($paramFetcher, $key, $value)
    {
        $param = new QueryParam();
        $param->name = $key;
        $param->default = $value;
        return $paramFetcher->addParam($param);
    }
}
