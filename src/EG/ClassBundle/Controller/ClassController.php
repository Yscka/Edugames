<?php

namespace EG\ClassBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClassController extends Controller
{
    public function indexAction(){

        // On récupére la liste des éleves si une classe est présente

        return $this->render('EGClassBundle:Class:index.html.twig');
    }
}