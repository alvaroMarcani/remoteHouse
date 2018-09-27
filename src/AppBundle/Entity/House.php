<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * House
 *
 * @ORM\Table(name="house", uniqueConstraints={@ORM\UniqueConstraint(name="idhouse_UNIQUE", columns={"idhouse"})}, indexes={@ORM\Index(name="fk_house_person_idx", columns={"person_idperson"})})
 * @ORM\Entity
 */
class House
{
    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="string", length=100, nullable=false)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="string", length=100, nullable=false)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=false)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="static_photo", type="string", length=255, nullable=false)
     */
    private $staticPhoto;

    /**
     * @var integer
     *
     * @ORM\Column(name="idhouse", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idhouse;

    /**
     * @var \AppBundle\Entity\Person
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="person_idperson", referencedColumnName="idperson")
     * })
     */
    private $personperson;


}

