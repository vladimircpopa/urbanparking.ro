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



    /**
     * Set startTime
     *
     * @param \DateTime $startTime
     *
     * @return Reservation
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;

        return $this;
    }

    /**
     * Get startTime
     *
     * @return \DateTime
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set endTime
     *
     * @param \DateTime $endTime
     *
     * @return Reservation
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;

        return $this;
    }

    /**
     * Get endTime
     *
     * @return \DateTime
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * Set availability
     *
     * @param boolean $availability
     *
     * @return Reservation
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;

        return $this;
    }

    /**
     * Get availability
     *
     * @return boolean
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * Set status
     *
     * @param boolean $status
     *
     * @return Reservation
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\Users $user
     *
     * @return Reservation
     */
    public function setUser(\AppBundle\Entity\Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set parkingSlot
     *
     * @param \AppBundle\Entity\ParkingSlot $parkingSlot
     *
     * @return Reservation
     */
    public function setParkingSlot(\AppBundle\Entity\ParkingSlot $parkingSlot = null)
    {
        $this->parkingSlot = $parkingSlot;

        return $this;
    }

    /**
     * Get parkingSlot
     *
     * @return \AppBundle\Entity\ParkingSlot
     */
    public function getParkingSlot()
    {
        return $this->parkingSlot;
    }
}
