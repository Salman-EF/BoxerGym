<?php

namespace GymBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Proxies\__CG__\GymBundle\Entity\Gym;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class GymController extends Controller
{
    public function indexAction()
    {
        return $this->render('GymBundle:Default:index.html.twig');
    }

    public function newGymAction() {
        return $this->render('GymBundle:Default:form.html.twig');
    }

    public function createGymAction(SymfonyRequest $request) {
        $gym_name = $request->get('name');
        $gym_adress = $request->get('adress');

        $gym_new = new Gym();
        $gym_new->setName($gym_name);
        $gym_new->setAdress($gym_adress);

        $this->getDoctrine()->getRepository(Gym::class)->createGym($gym_new);

        return $this->redirectToRoute('gym_homepage');
    }
}
