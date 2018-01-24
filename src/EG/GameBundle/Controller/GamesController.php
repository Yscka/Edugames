<?php

namespace EG\GameBundle\Controller;

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

    public function playAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $game = $em->getRepository("EGGameBundle:Games")->find($id);

        return $this->render("EGGameBundle:Games:play.html.twig", array(
            'game' => $game
        ));
    }
}