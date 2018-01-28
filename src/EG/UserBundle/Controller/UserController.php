<?php

namespace EG\UserBundle\Controller;

use EG\UserBundle\Entity\User;
use EG\UserBundle\Form\RegistrationType;
use EG\UserBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        $listUser = $em->getRepository('EGUserBundle:User')->findAll();

        return $this->render('EGUserBundle:User:index.html.twig', array(
            'listUser' => $listUser,
        ));
    }
    public function addAction(Request $request)
    {
        $user = new User();
        $form = $this->get('form.factory')->create(RegistrationType::class, $user);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $request->getSession()->getFlashBag()->add('Info', 'Enseignant modifié.');
            return $this->redirectToRoute('eg_user_homepage');
        }
        return $this->render('EGUserBundle:User:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('EGUserBundle:User')->find($id);
        $form = $this->get('form.factory')->create(RegistrationType::class, $user);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $userManager = $this->container->get('fos_user.user_manager');
            $userManager->updatePassword($user);
            $em->flush();
            $request->getSession()->getFlashBag()->add('Info', 'Enseignant modifié.');
            return $this->redirectToRoute('eg_user_homepage');
        }
        return $this->render('EGUserBundle:User:edit.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('EGUserBundle:User')->find($id);
        $listClass = $em->getRepository('EGClassBundle:Pupil')->findBy(array(
            'classroom' => $user
        ));
        $form = $this->get('form.factory')->create();
        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            foreach ($listClass as $classroom){
                $em->remove($classroom);
            }
            $em->remove($user);
            $em->flush();
            $request->getSession()->getFlashBag()->add('Info', 'Enseignant Supprimé.');
            return $this->redirectToRoute('eg_user_homepage');
        }
        return $this->render('EGUserBundle:User:delete.html.twig', array(
            'form' => $form->createView(),
            'user' => $user
        ));
    }
}