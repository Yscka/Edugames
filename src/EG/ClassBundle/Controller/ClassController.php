<?php

namespace EG\ClassBundle\Controller;

use EG\ClassBundle\Entity\ClassRoom;
use EG\ClassBundle\Form\ClassRoomType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ClassController extends Controller
{
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        // On récupére la liste des éleves si une classe est présente
        $listClass = $em->getRepository('EGClassBundle:ClassRoom')->findAll();

        return $this->render('EGClassBundle:Class:index.html.twig', array(
            'listClass' => $listClass
        ));
    }

    public function viewAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();

        $classRoom = $em->getRepository('EGClassBundle:ClassRoom')->find($id);

        $listPupil = $em->getRepository('EGClassBundle:Pupil')->findBy(array('classroom' => $classRoom));

        return $this->render('EGClassBundle:Class:view.html.twig', array(
            'listPupil' => $listPupil
        ));
    }

    public function addAction(Request $request){
        $classRoom = new ClassRoom();


        $form   = $this->get('form.factory')->create(ClassRoomType::class, $classRoom);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($classRoom);
            $em->flush();
            $request->getSession()->getFlashBag()->add('Info', 'Classe bien enregistrée.');
            return $this->redirectToRoute('eg_class_homepage');
        }
        return $this->render('EGClassBundle:Class:add.html.twig', array(
            'form' => $form->createView()
        ));
    }
}