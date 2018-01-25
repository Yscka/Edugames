<?php

namespace EG\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EGUserBundle:Default:index.html.twig');
    }
}
