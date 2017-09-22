<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Penalty
 *
 * @ORM\Table(name="penalty", indexes={@ORM\Index(name="reservation_id", columns={"reservation_id"})})
 * @ORM\Entity
 */
class Penalty
{
    /**
     * @var integer
     *
     * @ORM\Column(name="extra_time", type="integer", nullable=false)
     */
    private $extraTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Reservation
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Reservation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reservation_id", referencedColumnName="id")
     * })
     */
    private $reservation;


}

