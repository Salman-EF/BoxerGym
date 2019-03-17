<?php

namespace BoxerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BoxerBundle\Entity\Boxer;
use GymBundle\Entity\Gym;

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

        $new_boxers = [
            new Boxer("Salman","salman@gmail.com","SalmanPass",$gym1),
            new Boxer("Floyd","floyd@gmail.com","FloydPass",$gym2),
            new Boxer("Ali","ali@gmail.com","AliPass",$gym2),
            new Boxer("Mike","mike@gmail.com","MikePass",$gym1)
        ];
        
        $boxerRepo = $this->getDoctrine()->getRepository(Boxer::class);
        foreach ($new_boxers as $new_boxer) {
            if (!$boxerRepo->findByEmail($new_boxer->getEmail())) {
                $boxerRepo->createBoxer($new_boxer);
            }
        }

        return $this->render(
            'BoxerBundle:Default:index.html.twig',
            [
                'boxers'    => $boxerRepo->findAllOrderByName(), 
                'gyms'      => $gymRepo->findAll()]
        );
    }

    public function profileAction()
    {
        return $this->render('BoxerBundle:Default:profile.html.twig');
    }
}
