<?php

namespace EG\ClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EG\ClassBundle\Entity\ClassRoom;
use EG\GameBundle\Entity\Games;

/**
 * Pupil
 *
 * @ORM\Table(name="pupil")
 * @ORM\Entity(repositoryClass="EG\ClassBundle\Repository\PupilRepository")
 */
class Pupil
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\Column(name="birthdate", type="datetime")
     */
    private $birthdate;
    /**
     * Get id
     *
     * @return int
     */

    /**
     * @ORM\ManyToOne(targetEntity="EG\ClassBundle\Entity\ClassRoom", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $classroom;

    /**
     * @ORM\ManyToMany(targetEntity="EG\GameBundle\Entity\Games", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $games;

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Pupil
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Pupil
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Pupil
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set classroom.
     *
     * @param ClassRoom $classroom
     *
     * @return Pupil
     */
    public function setClassroom(ClassRoom $classroom)
    {
        $this->classroom = $classroom;

        return $this;
    }

    /**
     * Get classroom.
     *
     * @return ClassRoom
     */
    public function getClassroom()
    {
        return $this->classroom;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->games = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add game.
     *
     * @param Games $game
     *
     * @return Pupil
     */
    public function addGame(Games $game)
    {
        $this->games[] = $game;

        return $this;
    }

    /**
     * Remove game.
     *
     * @param Games $game
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeGame(Games $game)
    {
        return $this->games->removeElement($game);
    }

    /**
     * Get games.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGames()
    {
        return $this->games;
    }
}
