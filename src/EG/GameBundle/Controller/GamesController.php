<?php

namespace EG\GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GamesController extends Controller
{
    public function dragAndDropAction()
    {
        return $this->render("EGGameBundle:Games:dragAndDrop.html.twig");
    }
}