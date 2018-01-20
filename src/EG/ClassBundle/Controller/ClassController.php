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

    public function viewAction($id){
        $em = $this->getDoctrine()->getManager();

        $classRoom = $em->getRepository('EGClassBundle:ClassRoom')->find($id);

        if (null === $classRoom) {
            throw new NotFoundHttpException("La classe n'existe pas.");
        }

        $listPupil = $em->getRepository('EGClassBundle:Pupil')->findBy(array('classroom' => $classRoom));

        return $this->render('EGClassBundle:Class:view.html.twig', array(
            'listPupil' => $listPupil,
            'class' => $classRoom
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

    public function editAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $classRoom = $em->getRepository('EGClassBundle:ClassRoom')->find($id);

        if (null === $classRoom) {
            throw new NotFoundHttpException("La classe n'existe pas.");
        }

        $form   = $this->get('form.factory')->create(ClassRoomType::class, $classRoom);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('Info', 'Classe bien enregistrée.');
            return $this->redirectToRoute('eg_class_homepage');
        }
        return $this->render('EGClassBundle:Class:edit.html.twig', array(
            'form' => $form->createView(),
            'class' => $classRoom
        ));
    }
    public function deleteAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $classRoom = $em->getRepository('EGClassBundle:ClassRoom')->find($id);
        $listPupil = $em->getRepository('EGClassBundle:Pupil')->findBy(array(
            'classroom' => $classRoom
        ));
        if (null === $classRoom) {
            throw new NotFoundHttpException("La classe n'existe pas.");
        }

        $form = $this->get('form.factory')->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            foreach ($listPupil as $pupil){
                $em->remove($pupil);
            }
            $em->remove($classRoom);
            $em->flush();
            $request->getSession()->getFlashBag()->add('Info', 'Classe Supprimer.');
            return $this->redirectToRoute('eg_class_homepage');
        }

        return $this->render('EGClassBundle:Class:delete.html.twig', array(
            'class' => $classRoom,
            'form' => $form->createView()
        ));
    }

    public function deleteAllAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $classRoom = $em->getRepository('EGClassBundle:ClassRoom')->find($id);
        $listPupil = $em->getRepository('EGClassBundle:Pupil')->findBy(array(
            'classroom' => $classRoom
        ));

        if (null === $classRoom) {
            throw new NotFoundHttpException("La classe n'existe pas.");
        }

        $form = $this->get('form.factory')->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            foreach ($listPupil as $pupil) {
                $em->remove($pupil);
            }
            $em->flush();
            $request->getSession()->getFlashBag()->add('Info', 'Classe Supprimer.');
            return $this->redirectToRoute('eg_class_view', array(
                'id' => $id
            ));
        }

        return $this->render('EGClassBundle:Class:deleteAll.html.twig', array(
            'class' => $classRoom,
            'form' => $form->createView()
        ));
    }
}