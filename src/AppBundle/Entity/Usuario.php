<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="iduser_UNIQUE", columns={"iduser"})})
 * @ORM\Entity
 */
class Usuario extends BaseUser
{
    /**
     * @var string
     *
     * @ORM\Column(name="usuario_nombre", type="string", length=45, nullable=true)
     */
    protected $usuarioNombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="iduser", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $iduser;


}

