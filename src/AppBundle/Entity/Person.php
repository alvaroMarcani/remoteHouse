<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * Person
 *
 * @UniqueEntity(fields={"email"}, message="label.haveAccountWarning")
 * @ORM\Table(name="person", indexes={@ORM\Index(name="fk_person_user1_idx", columns={"id_usuario"})})
 * @ORM\Entity
 */
class Person
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     * @Assert\NotBlank(message="form.notblank")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=100, nullable=false)
     * @Assert\NotBlank(message="form.notblank")
     */
    private $lastName;

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
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="date", nullable=false)
     * @Assert\NotBlank(message="form.notblank")
     * @Assert\Date(message="form.notblank")
     * @Assert\LessThan("-18 years")
     *
     */
    private $birthdate;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=100, nullable=false)
     * @Assert\NotBlank(message="form.notblank")
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="form.notblank")
     * @Assert\Email(message="form.email")
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Usuario
     *
     * @ORM\OneToOne(targetEntity="Usuario", inversedBy="person")
     * @ORM\JoinColumn(name="id_usuario", referencedColumnName="id")
     */
    private $usuario;


    /**
     *
     * @ORM\OneToMany(targetEntity="House", mappedBy="idPerson")
     */
    private $houses;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->houses = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Person
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
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Person
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set photo
     *
     * @param string $photo
     *
     * @return Person
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set staticPhoto
     *
     * @param string $staticPhoto
     *
     * @return Person
     */
    public function setStaticPhoto($staticPhoto)
    {
        $this->staticPhoto = $staticPhoto;

        return $this;
    }

    /**
     * Get staticPhoto
     *
     * @return string
     */
    public function getStaticPhoto()
    {
        return $this->staticPhoto;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Person
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Person
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Person
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
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
     * Get FullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->name." ".$this->lastName;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Person
     */
    public function setUsuario(\AppBundle\Entity\Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Add trabajo
     *
     * @param \AppBundle\Entity\House $House
     *
     * @return Person
     */
    public function addHouse(\AppBundle\Entity\House $House)
    {
        $this->houses[] = $House;

        return $this;
    }

    /**
     * Remove House
     *
     * @param \AppBundle\Entity\House $House
     */
    public function removeHouse(\AppBundle\Entity\House $House)
    {
        $this->houses->removeElement($House);
    }

    /**
     * Get Houses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHouses()
    {
        return $this->houses;
    }
}
