<?php

namespace AppBundle\Repository;

use AppBundle\Repository\AbstractRepository;
use FOS\RestBundle\Request\ParamFetcher;
use Doctrine\ORM\QueryBuilder;
use Doctrine\DBAL\Types\Type;
// use AppBundle\Entity\State;
// use AppBundle\Entity\Frequency;


class ParkingRepository extends AbstractRepository {

    /**
     * @param ParamFetcher $paramFetcher
     * @return array
     */
    public function fetch(ParamFetcher $paramFetcher)
    {
        $qb = $this
                ->createQueryBuilder('i')
                ->setFirstResult($paramFetcher->get('offset'))
                ->setMaxResults($paramFetcher->get('limit'))
                ->orderBy('i.id', 'ASC')
        ;

        $qb = $this->fetchParameters($qb, $paramFetcher);

        return $qb->getQuery()->getResult();
    }



}
