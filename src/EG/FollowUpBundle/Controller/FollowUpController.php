<?php

namespace EG\FollowUpBundle\Controller;

use EG\FollowUpBundle\EGFollowUpBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        $listPupil = $em->getRepository('EGClassBundle:Pupil')->findby(array(
            'classroom' => $classroom
        ));
        return $this->render('EGFollowUpBundle:FollowUp:view.html.twig', array(
            'class' => $classroom,
            'listPupil' => $listPupil
        ));
    }

    public function pupilAction($id){
        $em = $this->getDoctrine()->getManager();
        $pupil = $em->getRepository('EGClassBundle:Pupil')->find($id);


        return $this->render('EGFollowUpBundle:FollowUp:pupil.html.twig', array(
            'pupil' => $pupil
        ));
    }

    public function pupilResultAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $pupil = $em->getRepository('EGClassBundle:Pupil')->find($id);
        $listResult = $em->getRepository('EGGameBundle:GameResult')->findBy(array(
            'pupil' => $pupil->getName()
        ), array('date' => 'DESC'), 15);

        return $this->render('EGFollowUpBundle:FollowUp:pupilResult.html.twig',array(
            'pupil' => $pupil,
            'listResult' => $listResult
        ));
    }
    public function gamesAction($id){
        $em= $this->getDoctrine()->getManager();
        $pupil= $em->getRepository('EGClassBundle:Pupil')->find($id);
        if (null === $pupil){
             throw new NotFoundHttpException('L\'élève n\'existe pas');
        }

       // $listGames = $pupil->getGames();
        return $this->render('EGFollowUpBundle:FollowUp:games.html.twig', array (
            //'listGames' => $listGames,
            'pupil' => $pupil
        ));
    }
    public function gameResultAction($id, $game){

        $em= $this->getDoctrine()->getManager();
        $pupil = $em->getRepository('EGClassBundle:Pupil')->find($id);
        $game = $em->getRepository('EGGameBundle:Games')->findOneBy(array(
            'nameGame' => $game,
        ));
        if(null ===$pupil){
            throw new NotFoundHttpException("L'élève n'existe pas");
        }

        $listResult = $em->getRepository('EGGameBundle:GameResult')->findBy(array(
            'pupil' => $pupil->getName(),
            'game' => $game->getNameGame(),
        ), array('date' => 'DESC'));

        return $this->render('EGFollowUpBundle:FollowUp:gameResult.html.twig',array(
            'pupil' => $pupil,
            'listResult' => $listResult,
            'game' => $game,
        ));
    }
}