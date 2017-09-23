<?php

namespace AppBundle\Repository;

use AppBundle\Repository\AbstractRepository;
use FOS\RestBundle\Request\ParamFetcher;
use Doctrine\ORM\QueryBuilder;
use Doctrine\DBAL\Types\Type;

class ParkingSlotRepository  extends AbstractRepository {

    /**
     * @param ParamFetcher $paramFetcher
     * @return array
     */
    public function fetch(ParamFetcher $paramFetcher)
    {
        // ($paramFetcher->get('startDate')
        // ($paramFetcher->get('endDate')
        // ($paramFetcher->get('parkingId')
        /*
SELECT * FROM
`reservation` as `r`
INNER JOIN 
`parking_slot` AS `ps` ON `ps`.`id` = `r`.`parking_slot_id`
WHERE 
`ps`.`parking_id` = 1
        */

        $sql = 'SELECT * FROM `reservation` as `r` INNER JOIN `parking_slot` AS `ps` ON `ps`.`id` = `r`.`parking_slot_id` WHERE  `ps`.`parking_id` = ' . $paramFetcher->get('parkingId') . ' AND `r`.`start_time` >= "' . $paramFetcher->get('startDate') . '"' . ' OR `r`.`end_time` <= "' . $paramFetcher->get('endDate') .'"';
        
        $em = $this->_em;
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll();

        
        foreach($res as $row){
            $parkingIds[] = $row['parking_id'];
        }

        $sql = 'SELECT `id`,`name` FROM `parking_slot` WHERE `id` NOT IN  (' . implode(',',$parkingIds) . ') AND `parking_id` = '. $paramFetcher->get('parkingId') ;

        $em = $this->_em;
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll();

        foreach($res as &$row){
            $row['price'] = '30RON/h';
        }        

        return $res;
    }
}
