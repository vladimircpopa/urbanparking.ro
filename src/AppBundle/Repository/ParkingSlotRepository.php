<?php

namespace AppBundle\Repository;

use AppBundle\Repository\AbstractRepository;
use FOS\RestBundle\Request\ParamFetcher;
use Doctrine\ORM\QueryBuilder;
use Doctrine\DBAL\Types\Type;

class ParkingSlotRepository extends AbstractRepository{

    /**
     * @param ParamFetcher $paramFetcher
     * @return array
     */
    public function fetch(ParamFetcher $paramFetcher)
    {
        $qb = $this
                ->createQueryBuilder('i')
                ->where('i.start_time >= :startDate')
                ->andWhere('i.end_time <= :endDate')
                ->setParameter('startDate',$paramFetcher->get('startDate'))
                ->setParameter('endDate', $paramFetcher->get('endDate'))
                ->setParameter('parkingId', $paramFetcher->get('parkingId'))

        ;

        $qb = $this->fetchParameters($qb, $paramFetcher);

        return $qb->getQuery()->getResult();
    }



}
