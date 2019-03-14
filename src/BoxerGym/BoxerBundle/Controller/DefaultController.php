<?php

namespace BoxerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BoxerBundle:Default:index.html.twig');
    }
}
