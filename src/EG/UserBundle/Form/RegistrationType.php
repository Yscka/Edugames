<?php

namespace EG\UserBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'required' => false,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                    ),
                ),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('roles', ChoiceType::class, array(
                'required' => true,
                'choices' => array('enseignant' => 'ROLE_ADMIN', 'admin' => 'ROLE_SUPER_ADMIN'),
                'multiple' => true,
                'expanded' => true,
                'label' => 'Rôle',
                'label_attr' => array('class' => 'checkbox-inline')
            ))
            ->add('name')
            ->add('lastname')
            ->add('classroom', EntityType::class, array(
                'class' => 'EGClassBundle:ClassRoom',
                'choice_label' => 'classroomName',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Classes',
                'label_attr' => array('class' => 'checkbox-inline')
            ))
            ->add('enabled', CheckboxType::class, array(
                'attr' => array(
                    'checked' => true
                )
            ))
            ->add('save', SubmitType::class)
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'eg_uset_registration';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}