<?php
/**
 * Created by PhpStorm.
 * User: Winnetou
 * Date: 2017-09-22
 * Time: 23:39
 */

namespace AppBundle\Repository;

use AppBundle\Repository\AbstractRepository;
use FOS\RestBundle\Request\ParamFetcher;
use Doctrine\ORM\QueryBuilder;
use Doctrine\DBAL\Types\Type;
// use AppBundle\Entity\State;
// use AppBundle\Entity\Frequency;


class ReservationRepository extends AbstractRepository
{
    /**
     * @param ParamFetcher $paramFetcher
     * @return array
     */
    public function fetch(ParamFetcher $paramFetcher)
    {
        $qb = $this
            ->createQueryBuilder('i')
            ->orderBy('i.id', 'ASC')
        ;

        $qb = $this->fetchParameters($qb, $paramFetcher);

        return $qb->getQuery()->getResult();
    }
}
