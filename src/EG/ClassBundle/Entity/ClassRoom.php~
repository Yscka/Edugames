<?php

namespace EG\ClassBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use EG\ClassBundle\Entity\pupil;

/**
 * Class
 *
 * @ORM\Table(name="classroom")
 * @ORM\Entity(repositoryClass="EG\ClassBundle\Repository\ClassRoomRepository")
 */
class ClassRoom
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
     * @ORM\Column(name="classroomName", type="string", length=255, unique=true)
     */
    private $classroomName;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set classroomName.
     *
     * @param string $classroomName
     *
     * @return ClassRoom
     */
    public function setClassroomName($classroomName)
    {
        $this->classroomName = $classroomName;

        return $this;
    }

    /**
     * Get classroomName.
     *
     * @return string
     */
    public function getClassroomName()
    {
        return $this->classroomName;
    }
    /**
     * Constructor
     */

}
