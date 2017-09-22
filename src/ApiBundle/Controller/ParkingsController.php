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
use AppBundle\Entity\Parking;
use AppBundle\Entity\ParkingSlot;
use AppBundle\Entity\Penalty;
use AppBundle\Entity\Reservation;
use AppBundle\Entity\Users;


/**
 * @author Gabriel Rondelli <gabriel.rondelli@orange.com>
 */
class ParkingsController extends AbstractApiController implements ClassResourceInterface {

    const ENTITY_PATH = 'AppBundle:Parking';

    /**
     * Returns a collection of Parking
     *
     * @ApiDoc(
     *   section = "Parking",
     *   resource = true,
     *   description = "Returns a collection of Parking",
     *   output = "AppBundle\Entity\Parking",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="name", requirements="\d+", default="0", strict=true, nullable=true, description="Offset from which to start listing items")
     * @Annotations\QueryParam(name="latitude", requirements="\d+", default="5", strict=true, nullable=true, description="How many items to return")
     * @Annotations\QueryParam(name="longitude", requirements="\d+", default="5", strict=true, nullable=true, description="How many items to return")
     * 
     * @param ParamFetcher $paramFetcher The request parameters validator
     * 
     * @return View
     */
    public function cgetAction(ParamFetcher $paramFetcher)
    {
        
        $parkings = $this->getRepository()->fetch($paramFetcher);

        return new View($parkings, Response::HTTP_OK);
    }

}

