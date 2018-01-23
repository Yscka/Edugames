<?php

namespace EG\ViewClassBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ViewClassController extends Controller
{
    public function indexAction()
    {
        //Vérification d'authentification

        $em = $this->getDoctrine()->getManager();
        $listClass = $em->getRepository("EGClassBundle:ClassRoom")->findAll();

        return $this->render('EGViewClassBundle:Class:index.html.twig', array(
            'listClass' => $listClass ));
    }
}
