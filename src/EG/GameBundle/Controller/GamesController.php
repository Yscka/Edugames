<?php

namespace EG\GameBundle\Controller;

use EG\GameBundle\Entity\GameResult;
use EG\GameBundle\Entity\Games;
use EG\GameBundle\Form\GamesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GamesController extends Controller
{

    public function indexAction($id){
        $em = $this->getDoctrine()->getManager();
        $pupil = $em->getRepository('EGClassBundle:Pupil')->find($id);
        $listGames = $em->getRepository('EGGameBundle:Games')->findAll();
        $games = $pupil->getGames();
        return $this->render("EGGameBundle:Games:index.html.twig", array(
            'pupil' => $pupil,
            'listGames' => $listGames,
            'games' => $games
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

    public function adminAction(){
        $em = $this->getDoctrine()->getManager();
        $games = $em->getRepository('EGGameBundle:Games')->findAll();

        return $this->render('EGGameBundle:Admin:index.html.twig', array(
            'games' => $games
        ));
    }
    public function addAction(Request $request){
        $game = new Games();
        $form   = $this->get('form.factory')->create(GamesType::class, $game);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($game);
            $em->flush();

            $request->getSession()->getFlashBag()->add('sucess', 'Jeu bien enregistrée.');

            return $this->redirectToRoute('eg_admin_game');
        }

        return $this->render('EGGameBundle:Admin:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    public function editAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $game = $em->getRepository('EGGameBundle:Games')->find($id);

        if (null === $game) {
            throw new NotFoundHttpException("Le jeu n'existe pas.");
        }

        $form   = $this->get('form.factory')->create(GamesType::class, $game);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Jeu modifié avec succés.');
            return $this->redirectToRoute('eg_admin_game');
        }

        return $this->render('EGGameBundle:Admin:edit.html.twig', array(
            'form' => $form->createView(),
            'game' => $game
        ));
    }
}