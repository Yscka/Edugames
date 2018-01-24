<?php

namespace EG\GameBundle\Controller;

use EG\GameBundle\Entity\GameResult;
use EG\GameBundle\Entity\Games;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GamesController extends Controller
{

    public function indexAction($id){
        $em = $this->getDoctrine()->getManager();
        $pupil = $em->getRepository('EGClassBundle:Pupil')->find($id);
        $listGames = $em->getRepository('EGGameBundle:Games')->findAll();

        return $this->render("EGGameBundle:Games:index.html.twig", array(
            'pupil' => $pupil,
            'listGames' => $listGames
        ));
    }

    public function playAction($id, $pupil, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pupil = $em->getRepository('EGClassBundle:Pupil')->findOneBy(array('name' => $pupil));
        $game = $em->getRepository("EGGameBundle:Games")->find($id);



        if($request->isXmlHttpRequest()) {
            $result = $em->getRepository('EGGameBundle:GameResult')->findOneBy(
                array('pupil' => $pupil->getName()),
                array('id' => 'DESC'));
            $completed = $request->request->get('complete');
            $result->setComplete($completed);
        }else{
            $result = new GameResult();
            $result->setGame($game->getNameGame());
            $result->setPupil($pupil->getName());
            $result->setComplete(0);
            $em->persist($result);
        }
        $em->flush();

        return $this->render("EGGameBundle:Games:play.html.twig", array(
            'game' => $game,
            'pupil' => $pupil
        ));
    }
}