<?php

namespace Dima\BatteriesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('DimaBatteriesBundle:Default:index.html.twig', array('name' => $name));
    }
}
