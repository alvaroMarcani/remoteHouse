<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Person;
use Doctrine\ORM\EntityRepository;
use FOS\UserBundle\Model\UserManager;

/**
 * Created by PhpStorm.
 * User: ALVARO
 * Date: 6/10/2018
 * Time: 17:06
 */
class RoomRepository extends EntityRepository
{
    public function getAllRoomsByPersona(Person $person)
    {
        return $this
            ->createQueryBuilder('r')
            ->leftJoin('r.idHouse', 'h')
            ->leftJoin('h.idPerson', 'p')
            ->where('p.id = :persona')
            ->setParameter('persona',$person->getId())
            ->getQuery()
            ->getResult()
            ;
    }
}