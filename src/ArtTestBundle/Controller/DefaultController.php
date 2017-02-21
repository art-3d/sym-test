<?php

namespace ArtTestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ArtTestBundle:Default:index.html.twig');
    }
}
