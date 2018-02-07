<?php

namespace EG\UserBundle\Controller;

use EG\UserBundle\Entity\User;
use EG\UserBundle\Form\changePasswordType;
use EG\UserBundle\Form\ProfileType;
use EG\UserBundle\Form\RegistrationType;
use EG\UserBundle\Form\UserType;
use FOS\UserBundle\Form\Type\ChangePasswordFormType;
use FOS\UserBundle\Form\Type\ProfileFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function indexAction(){
        $em = $this->getDoctrine()->getManager();
        $listUser = $em->getRepository('EGUserBundle:User')->findAll();

        return $this->render('EGUserBundle:Admin:index.html.twig', array(
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
        return $this->render('EGUserBundle:Admin:add.html.twig', array(
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
        return $this->render('EGUserBundle:Admin:edit.html.twig', array(
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
        return $this->render('EGUserBundle:Admin:delete.html.twig', array(
            'form' => $form->createView(),
            'user' => $user
        ));
    }

    public function profileAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('EGUserBundle:User')->find($id);

        return $this->render('EGUserBundle:User:profile.html.twig', array(
            'user' => $user
        ));
    }
    public function profilEditAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('EGUserBundle:User')->find($id);

        $form = $this->get('form.factory')->create(ProfileType::class, $user);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Profile modifié avec succés.');
            return $this->redirectToRoute('eg_user_profile', array(
                'id' => $id
            ));
        }

        return $this->render('EGUserBundle:User:edit.html.twig',array(
            'form' => $form->createView(),
            'user' => $user
        ));
    }

    public function changePasswordAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('EGUserBundle:User')->find($id);

        $form = $this->get('form.factory')->create(changePasswordType::class, $user);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $userManager = $this->container->get('fos_user.user_manager');
            $userManager->updatePassword($user);
            $em->flush();
            $request->getSession()->getFlashBag()->add('success', 'Mot de passe modifié avec succés.');
            return $this->redirectToRoute('eg_user_profile', array(
                'id' => $id
            ));
        }

        return $this->render('EGUserBundle:User:change_password.html.twig',array(
            'form' => $form->createView(),
            'user' => $user
        ));
    }
}