<?php

namespace EG\ClassBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PupilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('lastName', TextType::class)
            ->add('birthdate', DateType::class)
            ->add('games', EntityType::class, array(
                'class' => 'EGGameBundle:Games',
                'choice_label' => 'nameGame',
                'multiple' => true,
                'expanded' => true,
                'label' => 'Jeux',
                'label_attr' => array('class' => 'checkbox-inline')

            ))
            ->add('save', SubmitType::class, ['label' => 'Valider'])
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data-class' => 'EG\ClassBundle\Entity\ClassRoom'
        ));
    }
}