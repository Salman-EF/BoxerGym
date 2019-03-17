<?php

namespace GymBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GymController extends Controller
{
    public function indexAction()
    {
        return $this->render('GymBundle:Default:index.html.twig');
    }
}
