<?php

namespace EG\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EGCoreBundle:Default:index.html.twig');
    }
}
