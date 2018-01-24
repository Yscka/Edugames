<?php

namespace EG\ClassBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use EG\ClassBundle\Entity\ClassRoom;
use EG\ClassBundle\Entity\Pupil;
use EG\GameBundle\Entity\Games;

class LoadGames implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Drag and Drop'
        );

        foreach ($names as $name) {
            $game = new Games();
            $game->setNameGame($name);
            $manager->persist($game);
        }
        $manager->flush();
    }
}