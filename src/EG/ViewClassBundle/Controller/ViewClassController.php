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
    public function viewAction($id){

        $em = $this->getDoctrine()->getManager();
        $classroom = $em->getRepository("EGClassBundle:ClassRoom")->find($id);

        $listPupil= $em->getRepository("EGClassBundle:Pupil")->findBy(array ('classroom' => $classroom ));
        return $this->render("EGViewClassBundle:Class:view.html.twig", array(
            'listPupil' => $listPupil,
            'class' => $classroom
            ));
    }
}
