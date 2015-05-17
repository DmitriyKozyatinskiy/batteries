<?php

namespace Dima\BatteriesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Dima\BatteriesBundle\Entity\Battery;
use Dima\BatteriesBundle\Form\BatteryType;

class BatteriesController extends Controller
{
    public function addAction()
    {
        $form = $this->createForm(new BatteryType());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();
            $battery = new Battery();

            for ($i = 0; $i < $data->count; ++$i) {
                $battery->setType($data->type);
                $battery->setOwner($data->owner);

                $em->persist($battery);
            }

            $em->flush();

            return $this->redirectToRoute('add');
        } else {
            return $this->render('DimaBatteriesBundle:Batteries:add.html.twig', [
                'form' => $form->createView(),
                'error' => 'Error'
            ]);
        }
    }
}
