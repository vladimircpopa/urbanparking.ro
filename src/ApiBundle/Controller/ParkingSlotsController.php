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
use AppBundle\Entity\ParkingSlot;

/**
 * @author Gabriel Rondelli <gabriel.rondelli@orange.com>
 */
class ParkingSlotsController extends AbstractApiController implements ClassResourceInterface {

    const ENTITY_PATH = 'AppBundle:ParkingSlot';

    /**
     * Returns a collection of free Parking Slots
     *
     * @ApiDoc(
     *   section = "Parking Slots",
     *   resource = true,
     *   description = "Returns a collection of free Parking Slots",
     *   output = "AppBundle\Entity\ParkingSlot",
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="startDate", requirements="\d{4}\-\d{2}\-\d{2}\s\d{2}\:\d{2}", strict=true, nullable=false, description="Start Date")
     * @Annotations\QueryParam(name="endDate", requirements="\d{4}\-\d{2}\-\d{2}\s\d{2}\:\d{2}", strict=true, nullable=false, description="End Date")
     * @Annotations\QueryParam(name="parkingId", requirements="\d+", strict=true, nullable=false, description="Parking id")
     * @param ParamFetcher $paramFetcher The request parameters validator
     *
     * @return View
     */
    public function cgetAction(ParamFetcher $paramFetcher)
    {
        $parkingSlots = $this->getRepository()->fetch($paramFetcher);

        return new View($parkingSlots, Response::HTTP_OK);
    }
}