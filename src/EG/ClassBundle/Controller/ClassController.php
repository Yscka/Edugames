<?php

namespace EG\ClassBundle\Controller;

use EG\ClassBundle\Entity\ClassRoom;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClassController extends Controller
{
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        // On récupére la liste des éleves si une classe est présente
        $listClass = $em->getRepository('EGClassBundle:ClassRoom')->findAll();

        return $this->render('EGClassBundle:Class:index.html.twig', array(
            'listClass' => $listClass
        ));
    }

    public function viewAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();

        $listPupil = $em->getRepository('EGClassBundle:Pupil')->findAll();

        return $this->render('EGClassBundle:Class:view.html.twig', array(
            'listPupil' => $listPupil
        ));
    }
}