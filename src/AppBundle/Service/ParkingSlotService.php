<?php

namespace AppBundle\Service;

use Symfony\Component\DependencyInjection\Container;
use AppBundle\Service\AbstractEntityService;
use AppBundle\Entity\ParkingSlot;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Gabriel Rondelli <gabriel.rondelli@orange.com>
 */
class ParkingSlotService extends AbstractEntityService 
{

    const ENTITY_PATH = 'AppBundle:ParkingSlot';

    /**
     * @var \AppBundle\Repository\ParkingSlotRepository
     */
    protected $repository;
    
    public function __construct(Container $service_container)
    {
        parent::__construct($service_container);
        
        $this->repository = $this->entityManager->getRepository('AppBundle:ParkingSlot');
    }   
}
