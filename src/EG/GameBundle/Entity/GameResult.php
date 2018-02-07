<?php

namespace EG\GameBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GameResult
 *
 * @ORM\Table(name="game_result")
 * @ORM\Entity(repositoryClass="EG\GameBundle\Repository\GameResultRepository")
 */
class GameResult
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
     * @ORM\Column(name="game", type="string", length=255)
     */
    private $game;

    /**
     * @var string
     *
     * @ORM\Column(name="pupil", type="string", length=255)
     */
    private $pupil;

    /**
     * @var int
     *
     * @ORM\Column(name="complete", type="integer")
     */
    private $complete;

    /**
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

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
     * Set game.
     *
     * @param string $game
     *
     * @return GameResult
     */
    public function setGame($game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game.
     *
     * @return string
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set pupil.
     *
     * @param string $pupil
     *
     * @return GameResult
     */
    public function setPupil($pupil)
    {
        $this->pupil = $pupil;

        return $this;
    }

    /**
     * Get pupil.
     *
     * @return string
     */
    public function getPupil()
    {
        return $this->pupil;
    }

    /**
     * Set complete.
     *
     * @param int $complete
     *
     * @return GameResult
     */
    public function setComplete($complete)
    {
        $this->complete = $complete;

        return $this;
    }

    /**
     * Get complete.
     *
     * @return int
     */
    public function getComplete()
    {
        return $this->complete;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return GameResult
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
}
