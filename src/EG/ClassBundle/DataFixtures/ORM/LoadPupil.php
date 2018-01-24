<?php

namespace EG\ClassBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EG\ClassBundle\Entity\ClassRoom;
use EG\ClassBundle\Entity\Pupil;

class LoadPupil implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {


       $manager->flush();
    }

    function getOrder(){
        return 22;
    }
}