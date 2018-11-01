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
class UsuarioRepository extends EntityRepository
{
    public function createUsuarioFromPersona(Person $persona, $userManager)
    {
        $em = $this->getEntityManager();
        $usuario = $em->getRepository('AppBundle:Usuario')->findOneByEmail($persona->getEmail());
        if ($usuario) {
            // dump('usuario!!!');
            return false;
        }

        $usuario = $userManager->createUser();
        $usuario->setEmail($persona->getEmail());
        $usuario->setUsername($persona->getEmail());
        $usuario->setEnabled(true);
        $date=new \DateTime();
//        $persona=new Person();
        $passwd = substr($persona->getName(),0,2)."-".substr($persona->getLastName(), 0, 2).$date->format("s");
        $usuario->setPlainPassword($passwd);

//        $grupo = $em->getRepository('AppBundle:Grupo')->findOneByName('Usuario corriente');
//        if (!$grupo)
//            return false;

//        $usuario->addGrupo($grupo);
//        $em->getRepository('AppBundle:Grupo')->updateRolesFromGrupos($usuario);
        $em->flush();

        $userManager->updateUser($usuario);

        $persona->setIdUsuario($usuario);

        return $passwd;
    }

    private function generateRandomString($length = 10) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}