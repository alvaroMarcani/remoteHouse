<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Room
 *
 * @ORM\Table(name="room", uniqueConstraints={@ORM\UniqueConstraint(name="idroom_UNIQUE", columns={"idroom"})}, indexes={@ORM\Index(name="fk_room_house1_idx", columns={"house_idhouse"})})
 * @ORM\Entity
 */
class Room
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="door", type="boolean", nullable=true)
     */
    private $door;

    /**
     * @var boolean
     *
     * @ORM\Column(name="light", type="boolean", nullable=true)
     */
    private $light;

    /**
     * @var integer
     *
     * @ORM\Column(name="idroom", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idroom;

    /**
     * @var \AppBundle\Entity\House
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\House")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="house_idhouse", referencedColumnName="idhouse")
     * })
     */
    private $househouse;


}

