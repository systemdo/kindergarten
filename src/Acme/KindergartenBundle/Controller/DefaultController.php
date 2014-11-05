<?php

namespace Acme\KindergartenBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeKindergartenBundle:Default:index.html.twig', array('name' => $name));
    }
}
