<?php

namespace EG\GameBundle\Controller;

use EG\GameBundle\Entity\Games;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GamesController extends Controller
{

    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        $listGames = $em->getRepository("EGGameBundle:Games")->findAll();

        return $this->render("EGGameBundle:Games:index.html.twig", array(
            'listGames' => $listGames,
        ));
    }

    public function playAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $game = $em->getRepository("EGGameBundle:Games")->find($id);
        //if($request->isXmlHttpRequest()) {
            $test = $request->request->get('test');
          /*  $game2 = new Games();
            $game2->setNameGame($test);
            $em->persist($game2);
            $em->flush();*/
       // }
        return $this->render("EGGameBundle:Games:play.html.twig", array(
            'game' => $game,
            'test' => $test
        ));
    }
}