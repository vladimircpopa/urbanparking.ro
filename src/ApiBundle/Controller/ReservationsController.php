<?php

namespace ApiBundle\Controller;

use ApiBundle\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use FOS\RestBundle\Routing\ClassResourceInterface;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Controller\Annotations;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\Entity\Reservation;


/**
 * @author Gabriel Rondelli <gabriel.rondelli@orange.com>
 */
class ReservationsController extends AbstractApiController implements ClassResourceInterface {

    const ENTITY_PATH = 'AppBundle:Reservation';

    /**
     * Returns a collection of Reservations
     *
     * @ApiDoc(
     *   section = "Reservation",
     *   resource = true,
     *   description = "Returns a collection of Reservation",
     *   output = "AppBundle\Entity\Parking",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="name", strict=true, nullable=false, description="The name of the parking")
     * @Annotations\QueryParam(name="latitude", strict=true, nullable=true, description="Longitude of the parking")
     * @Annotations\QueryParam(name="longitude", strict=true, nullable=true, description="Latitude of the parking")
     * 
     * @return View
     */
    public function cgetAction()
    {
        $parkings = $this->getRepository()->findAll();

        return new View($parkings, Response::HTTP_OK);
    }



}

