<?php

namespace Dima\BatteriesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BatteriesController extends Controller
{
    public function addAction()
    {
        return $this->render('DimaBatteriesBundle:Batteries:add.html.twig');
    }
}
