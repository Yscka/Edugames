<?php

namespace EG\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('EGCoreBundle:Core:index.html.twig');
    }
}
