<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="user_id", columns={"user_id"}), @ORM\Index(name="parking_slot_id", columns={"parking_slot_id"}), @ORM\Index(name="status", columns={"status"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_time", type="datetime", nullable=false)
     */
    private $startTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_time", type="datetime", nullable=false)
     */
    private $endTime;

    /**
     * @var boolean
     *
     * @ORM\Column(name="availability", type="boolean", nullable=false)
     */
    private $availability;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \AppBundle\Entity\ParkingSlot
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ParkingSlot")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parking_slot_id", referencedColumnName="id")
     * })
     */
    private $parkingSlot;


}

