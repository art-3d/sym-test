<?php

namespace ArtTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ArtTestBundle\Entity\GuestBook;
use ArtTestBundle\Form\GuestBookType;

class DefaultController extends Controller
{
    public function guestBookAction(Request $request)
    {
        $guestBook = new GuestBook();

        $guestbooks = $this->getDoctrine()->getRepository('ArtTestBundle:GuestBook')
            ->findAll();

        $form = $this->createForm(GuestBookType::class, $guestBook);

        if ($request->isMethod($request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($form->getData());
                $em->flush();

                return $this->redirect($this->generateUrl('guestbook'));
            }
        }

        return $this->render('ArtTestBundle:Default:guestbook.html.twig', [
            'form' => $form->createView(),
            'guestbooks' => $guestbooks
        ]);
    }

    public function registerAction()
    {
        $form = $this->container->get('fos_user.registration.form');
        $formHandler = $this->container->get('fos_user.registration.form.handler');
        $confirmationEnabled = $this->container->getParameter('fos_user.registration.confirmation.enabled');

        $process = $formHandler->process($confirmationEnabled);
        if ($process) {
            $user = $form->getData();

            $guestBook = new GuestBook();
            $guestBook->setMessage("Greeting new user " . $user->getUsername());
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($guestBook);
            $em->flush();

            return $this->redirect($this->generateUrl('guestbook'));
        }

        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
