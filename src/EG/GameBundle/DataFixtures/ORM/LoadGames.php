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
        $name1 = 'Drag and Drop';
        $src1 = '/Edugames/web/js/game/dragAndDrop.js';
        $game1 = new Games();
        $game1->setNameGame($name1);
        $game1->setSrc($src1);
        $manager->persist($game1);

        $name2 = 'Memory des lettres';
        $src2 = '/Edugames/web/js/game/memoryLettres.js';
        $game2 = new Games();
        $game2->setNameGame($name2);
        $game2->setSrc($src2);
        $manager->persist($game2);

        $name3 = 'Memory des Chiffres (1-10)';
        $src3 = '/Edugames/web/js/game/memoryChiffres1a10.js';
        $game3 = new Games();
        $game3->setNameGame($name3);
        $game3->setSrc($src3);
        $manager->persist($game3);

        $name4 = 'Memory des Chiffres (11-20)';
        $src4 = '/Edugames/web/js/game/memoryChiffres11a20.js';
        $game4 = new Games();
        $game4->setNameGame($name4);
        $game4->setSrc($src4);
        $manager->persist($game4);
        $manager->flush();
    }

    function getOrder(){
        return 1;
    }
}