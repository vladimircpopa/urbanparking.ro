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
class ReservationsController extends AbstractApiController implements ClassResourceInterface {

    const ENTITY_PATH = 'AppBundle:Reservation';

    /**
     * Returns a collection of Reservation
     *
     * @ApiDoc(
     *   section = "Reservation",
     *   resource = true,
     *   description = "Returns a collection of Reservation",
     *   output = "AppBundle\Entity\Reservation",
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
        $reservations = $this->getRepository()->findAll();

        return new View($reservations, Response::HTTP_OK);
    }

    /**
     * Creates a new Reservation from the submitted data
     *
     * @ApiDoc(
     *   section = "Reservation",
     *   resource = true,
     *   description = "Creates a new Reservation from the submitted data",
     *   input = "AppBundle\Form\ReservationType",
     *   statusCodes = {
     *     201 = "Returned when successful",
     *     400 = "Returned when there is a bad request"
     *   }
     * )
     *
     * @param Request $request The HTTP request
     *
     * @return View
     *
     * @throws InputValidationException
     */
    public function postAction(Request $request)
    {
        try {
            $reservation = $this->createReservation($request);
        } catch (\Exception $ex) {
            return new View(
                json_encode(
                    array(
                        'code' => 'Error',
                        'message' => $ex->getMessage()
                    )
                ),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
        return new View($reservation, Response::HTTP_CREATED);
    }

    /**
     * @param Request $request
     * @param Reservation $blackout
     * @return Reservation
     * @throws InputValidationException
     */
    private function createReservation(Request $request)
    {
        return $this->getReservationService()->createReservation($request);
    }

    /**
     * @return \AppBundle\Service\ReservationService
     */
    private function getReservationService()
    {
        return $this->container->get('reservation_service');
    }
}