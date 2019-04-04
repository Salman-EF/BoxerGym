<?php

namespace BoxerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BoxerBundle\Entity\Boxer;
use GymBundle\Entity\Gym;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class BoxerController extends Controller
{
    public function indexAction()
    {
        $gymRepo = $this->getDoctrine()->getRepository(Gym::class);
        $boxerRepo = $this->getDoctrine()->getRepository(Boxer::class);

        return $this->render(
            'BoxerBundle:Default:index.html.twig',
            [
                'boxers'    => $boxerRepo->findAll(), 
                'lastfive_boxers'    => $boxerRepo->findLastFive(), 
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

    public function showBoxerAction($id)
    {
        return $this->render(
            'BoxerBundle:Default:show.html.twig', 
            [
                'boxer'  => $this->getDoctrine()->getRepository(Boxer::class)->find($id),
                'gyms'  => $this->getDoctrine()->getRepository(Gym::class)->findAll()
            ]
        );
    }

    public function deleteBoxerAction($id)
    {
        $boxer = $this->getDoctrine()->getRepository(Boxer::class)->find($id);
        $this->getDoctrine()->getRepository(Boxer::class)->deleteBoxer($boxer);
        return $this->redirectToRoute('boxer_homepage');
    }

    public function updateBoxerAction($id, Request $request)
    {
        $boxer = $this->getDoctrine()->getRepository(Boxer::class)->find($id);
        $boxer_name = $request->get('name');
        $boxer_email = $request->get('email');
        $boxer_gym = $request->get('gym');
        $boxer_gym = $this->getDoctrine()->getRepository(Gym::class)->find($boxer_gym);

        $boxer->setName($boxer_name);
        $boxer->setEmail($boxer_email);
        $boxer->setGym($boxer_gym);
        $this->getDoctrine()->getRepository(Boxer::class)->updateBoxer($boxer);

        return $this->redirectToRoute('boxer_homepage');
    }

    public function sendToBoxerAction($id, Request $request)
    {
        $boxer = $this->getDoctrine()->getRepository(Boxer::class)->find($id);
        $message = (new \Swift_Message('Hello Email'))
            ->setFrom('support@boxerapp.com')
            ->setTo($boxer->getEmail())
            ->setBody(
                $this->renderView(
                    'BoxerBundle:Emails:hello.html.twig',
                    ['boxer' => $boxer]
                ),
                'text/html'
            )
            /*
             * If you also want to include a plaintext version of the message
            ->addPart(
                $this->renderView(
                    'Emails/registration.txt.twig',
                    ['name' => $name]
                ),
                'text/plain'
            )
            */
        ;

        $this->get('mailer')->send($message);

        return new JsonResponse("email sent");

    }
}
