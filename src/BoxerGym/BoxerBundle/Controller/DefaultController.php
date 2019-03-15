<?php

namespace BoxerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BoxerBundle\Entity\Boxer;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $boxer1 = new Boxer("Salman","salman@gmail.com","SalmanPass");
        $boxer2 = new Boxer("Boxer2","boxer2@gmail.com","Boxer2Pass");

        $em = $this->getDoctrine()->getManager();
        $em->persist($boxer1);
        $em->persist($boxer2);
        $em->flush();

        return $this->render(
            'BoxerBundle:Default:index.html.twig',
            ['boxers' => $em->getRepository(Boxer::class)->findAll()]
        );
    }

    public function profileAction()
    {
        return $this->render('BoxerBundle:Default:profile.html.twig');
    }
}
