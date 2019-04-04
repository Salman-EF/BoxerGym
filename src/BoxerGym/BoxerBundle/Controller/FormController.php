<?php
/**
 * SALMAN in The House
 */

namespace BoxerBundle\Controller;


use BoxerBundle\Entity\Boxer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class FormController extends Controller
{

    public function validNewBoxerAction(Request $request) {
        $name = $request->get('name');
        $email = $request->get('email');

        $nameExists = $this->getDoctrine()->getRepository(Boxer::class)->findByName($name);
        $emailExists = $this->getDoctrine()->getRepository(Boxer::class)->findByEmail($email);

        if ($nameExists != null) return new JsonResponse("name");
        else if ($emailExists != null) return  new JsonResponse("email");
        else return  new JsonResponse("You're Good");
    }

}