<?php

namespace App\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Single : artist as a single person
 *
 * @package App\CoreBundle\Entity
 *
 * @ORM\Entity
 */
class Single extends Artist {
    /**
     * @var \DateTime $birthday
     *
     * @ORM\Column(type="date", nullable=true)
     */
    protected $birthday;
    /**
     * @var string $firstname
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $firstname;

    /**
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param \DateTime $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "{$this->getFirstname()} ".parent::__toString();
    }
}