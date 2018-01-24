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

        $name = 'Drag and Drop';
        $src = '/Edugames/web/js/game/dragAndDrop.js';
            $game = new Games();
            $game->setNameGame($name);
            $game->setSrc($src);
            $manager->persist($game);

        $manager->flush();
    }

    function getOrder(){
        return 1;
    }
}