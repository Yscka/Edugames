<?php

namespace EG\ClasseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EGClasseBundle::index.html.twig');
    }
}
