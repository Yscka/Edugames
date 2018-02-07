<?php

namespace EG\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EG\GameBundle\Entity\Images;

/**
 * Games
 *
 * @ORM\Table(name="games")
 * @ORM\Entity(repositoryClass="EG\GameBundle\Repository\GamesRepository")
 */
class Games
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nameGame", type="string", length=255)
     */
    private $nameGame;

    /**
     * @ORM\Column(name="src", type="string", length=255)
     *
     */
    private $src;

    /**
     * @ORM\OneToOne(targetEntity="EG\GameBundle\Entity\Images", cascade ={"persist"})
     */
    private $images;
    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nameGame.
     *
     * @param string $nameGame
     *
     * @return Games
     */
    public function setNameGame($nameGame)
    {
        $this->nameGame = $nameGame;

        return $this;
    }

    /**
     * Get nameGame.
     *
     * @return string
     */
    public function getNameGame()
    {
        return $this->nameGame;
    }

    /**
     * Set src.
     *
     * @param string $src
     *
     * @return Games
     */
    public function setSrc($src)
    {
        $this->src = $src;

        return $this;
    }

    /**
     * Get src.
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }


    /**
     * Set images.
     *
     * @param Images|null $images
     *
     * @return Games
     */
    public function setImages(Images $images = null)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images.
     *
     * @return Images|null
     */
    public function getImages()
    {
        return $this->images;
    }
}
