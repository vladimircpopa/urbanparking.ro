<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use FOS\RestBundle\Request\ParamFetcher;
use Doctrine\ORM\QueryBuilder;

/**
 * @author Samuel Chiriluta <samuel.chiriluta@orange.com>
 */
abstract class AbstractRepository extends EntityRepository {

    /**
     * @param ParamFetcher $paramFetcher
     * @return integer
     */
    public function count(ParamFetcher $paramFetcher)
    {
        $qb = $this->createQueryBuilder('i');

        $qb->select('COUNT(i)');

        $qb = $this->fetchParameters($qb, $paramFetcher);

        $query = $qb->getQuery();

        return $query->getSingleScalarResult();
    }

    /**
     * @param QueryBuilder $qb
     * @param ParamFetcher $paramFetcher
     * @return QueryBuilder
     */
    protected function fetchParameters(QueryBuilder $qb, ParamFetcher $paramFetcher)
    {
        return $qb;
    }

}
