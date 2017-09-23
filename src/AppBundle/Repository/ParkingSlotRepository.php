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

        $sql = "SELECT r.parking_slot_id 
          FROM `reservation` as `r` 
          INNER JOIN `parking_slot` AS `ps` ON `ps`.`id` = `r`.`parking_slot_id` 
          WHERE  `ps`.`parking_id` = ? AND `r`.`start_time` >= ? OR `r`.`end_time` <= ?
        ";
        
        $em = $this->_em;
        $stmt = $em->getConnection()->prepare($sql);
        $parkingId = $paramFetcher->get('parkingId');
        $stmt->execute(array($parkingId, $paramFetcher->get('startDate'), $paramFetcher->get('endDate')));
        $res = $stmt->fetchAll();
        $parkingSlotIds = array();

        foreach($res as $row){
            $parkingSlotIds[] = $row['parking_slot_id'];
        }

        $sql = "SELECT `id`,`name` 
          FROM `parking_slot` WHERE `id` NOT IN  (?) AND `parking_id` = ?
        ";

        $em = $this->_em;
        $stmt = $em->getConnection()->prepare($sql);
        $stmt->execute(array(implode(',', $parkingSlotIds), $parkingId));
        $res = $stmt->fetchAll();

        foreach($res as &$row){
            $row['price'] = '30RON/h';
        }        

        return $res;
    }
}
