<?php

namespace BoxerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BoxerBundle\Entity\Boxer;
use GymBundle\Entity\Gym;
use Symfony\Component\HttpFoundation\Request;

class BoxerController extends Controller
{
    public function indexAction()
    {
        $gym1 = new Gym("Tristar Gym", "Canada");
        $gym2 = new Gym("Banssa Gym", "Casa");

        $new_gyms = [ $gym1, $gym2 ];

        $gymRepo = $this->getDoctrine()->getRepository(Gym::class);
        foreach ($new_gyms as $new_gym) {
            if (!$gymRepo->findByName($new_gym->getName())) {
                $gymRepo->createGym($new_gym);
            }
        }
        $boxerRepo = $this->getDoctrine()->getRepository(Boxer::class);

        return $this->render(
            'BoxerBundle:Default:index.html.twig',
            [
                'boxers'    => $boxerRepo->findAllOrderByName(), 
                'gyms'      => $gymRepo->findAll()
            ]
        );
    }

    public function newBoxerAction()
    {
        return $this->render(
            'BoxerBundle:Default:form.html.twig', 
            [
                'gyms'  => $this->getDoctrine()->getRepository(Gym::class)->findAll()
            ]
        );
    }
    
    public function createBoxerAction(Request $request)
    {
        $boxer_name = $request->get('name');
        $boxer_email = $request->get('email');
        $boxer_gym = $request->get('gym');
        $boxer_gym = $this->getDoctrine()->getRepository(Gym::class)->find($boxer_gym);

        $new_boxer = new Boxer();
        $new_boxer->setName($boxer_name);
        $new_boxer->setEmail($boxer_email);
        $new_boxer->setGym($boxer_gym);

        $this->getDoctrine()->getRepository(Boxer::class)->createBoxer($new_boxer);

        return $this->redirectToRoute('boxer_homepage');
    }
}
