<?php

namespace EG\ClassBundle\Controller;

use EG\ClassBundle\Entity\Pupil;
use EG\ClassBundle\Form\PupilType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PupilController extends Controller
{
    public function addAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $pupil = new Pupil();
        $form = $this->get('form.factory')->create(PupilType::class, $pupil);
        $classroom = $em->getRepository('EGClassBundle:ClassRoom')->find($id);
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $pupil->setClassroom($classroom);
            $em->persist($pupil);
            $em->flush();
            $request->getSession()->getFlashBag()->add('Info', 'Nouvel éléve ajouté à la classe.');
            return $this->redirectToRoute('eg_class_view', array(
                'id' => $id
            ));
        }
        return $this->render('EGClassBundle:Pupil:add.html.twig',array(
            'form' => $form->createView(),
            'class' => $classroom
        ));
    }

    public function deleteAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();

        $pupil = $em->getRepository('EGClassBundle:Pupil')->find($id);
        $classroom = $pupil->getClassroom();

        if (null === $pupil) {
            throw new NotFoundHttpException("L'éléve n'existe pas.");
        }

        $form = $this->get('form.factory')->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->remove($pupil);
            $em->flush();
            $request->getSession()->getFlashBag()->add('Info', 'Classe Supprimer.');
            return $this->redirectToRoute('eg_class_view', array(
                'id' => $classroom->getId(),
            ));
        }

        return $this->render('EGClassBundle:Pupil:delete.html.twig', array(
            'form' => $form->createView(),
            'pupil' => $pupil,
            'class' => $classroom
        ));
    }
}