<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HomeController
 * @Route("home")
 */
class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Method("GET")
     */
    public function homeAction()
    {
        return $this->render(
            'home/index.html.twig'
        );
    }

}