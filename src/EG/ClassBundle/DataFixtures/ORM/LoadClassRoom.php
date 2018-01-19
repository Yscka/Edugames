<?php

namespace EG\ClassBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadClassRoom implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Classe de test'
        );

        foreach ($names as $name) {
            $classroom = new ClassRoom();
            $classroom->setName($name);

            $manager->persist($classroom);
        }
        $manager->flush();
    }
}