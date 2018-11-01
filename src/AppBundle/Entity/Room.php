<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="room", indexes={@ORM\Index(name="fk_room_house1_idx", columns={"id_house"})})
 * @ORM\Entity
 */
class Room
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="door", type="boolean", nullable=false)
     */
    private $door;

    /**
     * @var boolean
     *
     * @ORM\Column(name="light", type="boolean", nullable=false)
     */
    private $light;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\House
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\House")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_house", referencedColumnName="id")
     * })
     */
    private $idHouse;



    /**
     * Set name
     *
     * @param string $name
     *
     * @return Room
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
     * Set door
     *
     * @param boolean $door
     *
     * @return Room
     */
    public function setDoor($door)
    {
        $this->door = $door;

        return $this;
    }

    /**
     * Get door
     *
     * @return boolean
     */
    public function getDoor()
    {
        return $this->door;
    }

    /**
     * Set light
     *
     * @param boolean $light
     *
     * @return Room
     */
    public function setLight($light)
    {
        $this->light = $light;

        return $this;
    }

    /**
     * Get light
     *
     * @return boolean
     */
    public function getLight()
    {
        return $this->light;
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
     * Set idHouse
     *
     * @param \AppBundle\Entity\House $idHouse
     *
     * @return Room
     */
    public function setIdHouse(\AppBundle\Entity\House $idHouse = null)
    {
        $this->idHouse = $idHouse;

        return $this;
    }

    /**
     * Get idHouse
     *
     * @return \AppBundle\Entity\House
     */
    public function getIdHouse()
    {
        return $this->idHouse;
    }

    public function __toString() {
        return $this->name;
    }
}
