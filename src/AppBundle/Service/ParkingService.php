<?php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\Container;
use AppBundle\Service\AbstractEntityService;
use AppBundle\Entity\Parking;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Gabriel Rondelli <gabriel.rondelli@orange.com>
 */

class ParkingService extends AbstractEntityService
{

    const ENTITY_PATH = 'AppBundle:Parking';

    /**
     * @var \AppBundle\Repository\ParkingRepository
     */
    protected $repository;
    
    public function __construct(Container $service_container)
    {
        parent::__construct($service_container);
        
        $this->repository = $this->entityManager->getRepository('AppBundle:Parking');
    }   
        
    
    public function createParking(Request $request, Parking $parking = null)
    {
        $parking = $parking ? $parking : new Parking;

        $em = $this->entityManager;
        
        $em->persist($parking);
        $em->flush();

        return $parking;
    }
}
