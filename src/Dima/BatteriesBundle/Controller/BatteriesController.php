<?php

namespace Dima\BatteriesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Dima\BatteriesBundle\Entity\Battery;
use Dima\BatteriesBundle\Form\BatteryType;

class BatteriesController extends Controller
{
    public function showAction()
    {
        $em = $this->getDoctrine()->getManager();

        $batteries = $em
            ->getRepository('DimaBatteriesBundle:Battery')
            ->countAllGroupedByType();

        return $this->render('DimaBatteriesBundle:Batteries:show.html.twig', [
            'batteries' => $batteries
        ]);
    }

    public function addAction(Request $request)
    {
        $form = $this->createForm(new BatteryType());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $count = $form['count']->getData();
            $owner = $form['owner']->getData();
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();

            for ($i = 0; $i < $count; ++$i) {
                $em->persist($data);
                $em->flush();
                $em->clear();
            }

            $this->addFlash(
                'success', ($owner ? $owner : 'Anonymous') . ', you have successfully added ' . $count . ' batteries!'
            );
        }

        return $this->render('DimaBatteriesBundle:Batteries:add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function resetAction()
    {
        $em = $this->getDoctrine()->getManager();

        $em->getRepository('DimaBatteriesBundle:Battery')->deleteAll();

        $em->flush();

        $this->addFlash(
            'notify', 'You have successfully reset all data.'
        );

        return $this->redirectToRoute('show');
    }
}
