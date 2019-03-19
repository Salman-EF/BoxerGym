<?php

namespace GymBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GymBundle\Entity\Gym;
use Symfony\Component\HttpFoundation\Request;

class GymController extends Controller
{
    public function indexAction()
    {
        return $this->render('GymBundle:Default:index.html.twig');
    }

    public function newGymAction() {
        return $this->render('GymBundle:Default:form.html.twig');
    }

    public function createGymAction(Request $request) {
        $gym_name = $request->get('name');
        $gym_address = $request->get('address');

        $gym_new = new Gym();
        $gym_new->setName($gym_name);
        $gym_new->setAddress($gym_address);

        $this->getDoctrine()->getRepository(Gym::class)->createGym($gym_new);

        return $this->redirectToRoute('gym_homepage');
    }

    public function showGymAction($id)
    {
        return $this->render(
            'GymBundle:Default:show.html.twig', 
            [
                'gym'  => $this->getDoctrine()->getRepository(Gym::class)->find($id)
            ]
        );
    }

    public function deleteGymAction($id)
    {
        $gym = $this->getDoctrine()->getRepository(Gym::class)->find($id);
        $this->getDoctrine()->getRepository(Gym::class)->deleteGym($gym);

        return $this->redirectToRoute('boxer_homepage');
    }

    public function updateGymAction($id, Request $request)
    {
        $gym = $this->getDoctrine()->getRepository(Gym::class)->find($id);
        $gym_name = $request->get('name');
        $gym_address = $request->get('address');

        $gym->setName($gym_name);
        $gym->setAddress($gym_address);
        $this->getDoctrine()->getRepository(Gym::class)->updateGym($gym);

        return $this->redirectToRoute('boxer_homepage');
    }
}
