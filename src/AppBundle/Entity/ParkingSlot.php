<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Traits\TimestampableTrait;
use Symfony\Component\Validator\Constraints;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping\Index;


/**
 * ParkingSlot
 * 
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ParkingSlotRepository")
 * @Serializer\ExclusionPolicy("all")
 * @ORM\Table(name="parking_slot", indexes={@ORM\Index(name="parking_id", columns={"parking_id"})})
 */
class ParkingSlot
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Parking
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Parking")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parking_id", referencedColumnName="id")
     * })
     */
    private $parking;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return ParkingSlot
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * Set parking
     *
     * @param \AppBundle\Entity\Parking $parking
     *
     * @return ParkingSlot
     */
    public function setParking(\AppBundle\Entity\Parking $parking = null)
    {
        $this->parking = $parking;

        return $this;
    }

    /**
     * Get parking
     *
     * @return \AppBundle\Entity\Parking
     */
    public function getParking()
    {
        return $this->parking;
    }
}
