<?php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\Container;
use AppBundle\Service\AbstractEntityService;
use AppBundle\Entity\Reservation;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Gabriel Rondelli <gabriel.rondelli@orange.com>
 */
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
        
    
    public function createReservation(Request $request, Reservation $reservation = null)
    {
        $reservation = $reservation ? $reservation : new Reservation;

        $em = $this->entityManager;
        
        $em->persist($reservation);
        $em->flush();

        return $reservation;
    }
}
