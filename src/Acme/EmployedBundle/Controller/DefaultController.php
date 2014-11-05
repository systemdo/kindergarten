<?php

namespace Acme\EmployedBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeEmployedBundle:Default:index.html.twig', array('name' => $name));
    }
}
