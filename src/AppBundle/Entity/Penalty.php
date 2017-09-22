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

    /**
     * Set extraTime
     *
     * @param integer $extraTime
     *
     * @return Penalty
     */
    public function setExtraTime($extraTime)
    {
        $this->extraTime = $extraTime;

        return $this;
    }

    /**
     * Get extraTime
     *
     * @return integer
     */
    public function getExtraTime()
    {
        return $this->extraTime;
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
     * Set reservation
     *
     * @param \AppBundle\Entity\Reservation $reservation
     *
     * @return Penalty
     */
    public function setReservation(\AppBundle\Entity\Reservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \AppBundle\Entity\Reservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }
}