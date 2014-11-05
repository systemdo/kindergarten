<?php

namespace Acme\ThemesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeThemesBundle:Default:index.html.twig', array('name' => $name));
    }
}
