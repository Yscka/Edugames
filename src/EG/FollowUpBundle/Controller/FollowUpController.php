<?php

namespace EG\FollowUpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FollowUpController extends Controller
{
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        $listClass = $em->getRepository('EGClassBundle:ClassRoom')->findAll();

        return $this->render('EGFollowUpBundle:FollowUp:index.html.twig', array(
            'listClass' => $listClass,
        ));
    }

    public function viewAction($id){
        $em = $this->getDoctrine()->getManager();
        $classroom = $em->getRepository('EGClassBundle:ClassRoom')->find($id);

        return $this->render('EGFollowUpBundle:FollowUp:view.html.twig', array(
            'class' => $classroom,
        ));
    }

    public function pupilAction($id){
        $em = $this->getDoctrine()->getManager();
        $classroom = $em->getRepository('EGClassBundle:ClassRoom')->find($id);
        $listPupil = $em->getRepository('EGClassBundle:Pupil')->findby(array(
            'classroom' => $classroom
        ));
        return $this->render('EGFollowUpBundle:FollowUp:pupil.html.twig', array(
            'class' => $classroom,
            'listPupil' => $listPupil
        ));
    }

    public function pupilResultAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $pupil = $em->getRepository('EGClassBundle:Pupil')->find($id);
        $listResult = $em->getRepository('EGGameBundle:GameResult')->findBy(array(
            'pupil' => $pupil->getName()
        ));

        return $this->render('EGFollowUpBundle:FollowUp:pupilResult.html.twig',array(
            'pupil' => $pupil,
            'listResult' => $listResult
        ));
    }
}