<?php

namespace EG\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EG\ClassBundle\Entity\Classroom;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Admin
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="EG\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=180, nullable=false)
     */
    protected $name;

    /**
     * @ORM\Column(name="lastname", type="string", length=180, nullable=false)
     */
    protected $lastname;

    /**
     * @ORM\ManyToMany(targetEntity="EG\ClassBundle\Entity\ClassRoom", cascade={"persist"})
     */
    protected $classroom;
    /**
     * Set name.
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set lastname.
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }



    /**
     * Add classroom.
     *
     * @param Classroom $classroom
     *
     * @return User
     */
    public function addClassroom(Classroom $classroom)
    {
        $this->classroom[] = $classroom;

        return $this;
    }

    /**
     * Remove classroom.
     *
     * @param Classroom $classroom
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeClassroom(Classroom $classroom)
    {
        return $this->classroom->removeElement($classroom);
    }

    /**
     * Get classroom.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClassroom()
    {
        return $this->classroom;
    }
}
