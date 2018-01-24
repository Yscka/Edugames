<?php

namespace EG\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EGGameBundle:Default:index.html.twig');
    }
}
