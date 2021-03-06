<?php

namespace EG\ClassBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EG\ClassBundle\Entity\ClassRoom;
use EG\ClassBundle\Entity\Pupil;

class LoadClassRoom implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = 'ClasseTest';



        $classroom = new ClassRoom();
        $classroom->setClassroomName($names);

        $pupil1 = new Pupil();
        $pupil1->setName('eleve1');
        $pupil1->setLastname('test1');
        $pupil1->setBirthdate(new \DateTime('2010-01-01'));
        $pupil1->setClassroom($classroom);

        $manager->persist($pupil1);

        $pupil2 = new Pupil();
        $pupil2->setName('eleve2');
        $pupil2->setLastname('test2');
        $pupil2->setBirthdate(new \DateTime('2010-02-19'));
        $pupil2->setClassroom($classroom);

        $manager->persist($pupil2);


        $manager->flush();
    }

    function getOrder(){
        return 2;
    }
}