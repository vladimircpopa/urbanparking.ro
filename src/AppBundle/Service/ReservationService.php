<?php
/**
 * Created by PhpStorm.
 * User: Winnetou
 * Date: 2017-09-22
 * Time: 23:36
 */

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\Container;
use AppBundle\Service\AbstractEntityService;
use AppBundle\Entity\Parking;
use AppBundle\Entity\ParkingSlot;
use AppBundle\Entity\Reservation;
use AppBundle\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class ReservationService extends AbstractEntityService
{
    const ENTITY_PATH = 'AppBundle:Reservation';

    /**
     * @var \AppBundle\Repository\ReservationRepository
     */
    protected $repository;

    public function __construct(Container $service_container)
    {
        parent::__construct($service_container);

        $this->repository = $this->entityManager->getRepository('AppBundle:Reservation');
    }


    public function createReservation(Request $request)
    {
        $session = new Session();
        $userId = $session->get('user_id', 0);

        if ($userId) {
            $repository = $this->getDoctrine()->getRepository(Users::class);
            $user = $repository->find($userId);
        } else {
            $user = null;
        }

        if ($user == null || $user->getId() == null) {
            throw new \Exception('You must be logged in, in order to reserve parking slot!');
        }

        $startTime = $request->get('start_time');
        $endTime = $request->get('end_time');
        $parkingId = $request->get('parking_id');

        $parkingRepository = $this->getDoctrine()->getRepository(Parking::class);
        $parking = $parkingRepository->find($parkingId);
        if (empty($parking)) {
            throw new \Exception('Invalid parking!');
        }

        $parkingSlotRepository = $this->getDoctrine()->getRepository(ParkingSlot::class);
        $parkingSlots = $parkingSlotRepository->findAll();
        $parkingSlot = $parkingSlots[0];

        $reservation = new Reservation;
        $reservation->setParkingSlot($parkingSlot);
        $reservation->setUser($user);
        $reservation->setStartTime(new \DateTime($startTime));
        $reservation->setEndTime(new \DateTime($endTime));
        $reservation->setAvailability(0);
        $reservation->setStatus(1);


        $em = $this->entityManager;

        $em->persist($reservation);
        $em->flush();

        return $reservation;
    }

    public function getDoctrine()
    {
        return $this->container->get('doctrine');
    }
}
