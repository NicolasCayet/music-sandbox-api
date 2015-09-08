<?php

namespace App\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Single : artist as a single person
 *
 * @package App\CoreBundle\Entity
 *
 * @ORM\Table(name="artists_single")
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
     * @var string $lastname
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $lastname;
    /**
     * @var ArrayCollection $bands Band(s) the artist is member of
     *
     * @ORM\ManyToMany(targetEntity="Band", mappedBy="members")
     */
    protected $bands;

    public function __construct()
    {
        $this->bands = new ArrayCollection();
    }

    /**
     * @param boolean $allowCalculated Whether the calculated version should be returned if no value specified for name
     * @return string
     */
    public function getName($allowCalculated = true)
    {
        return parent::getName() || !$allowCalculated ?
            parent::getName() :
            $this->getFirstname().' '.$this->getLastname();
    }
    /**
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }
    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @return ArrayCollection
     */
    public function getBands()
    {
        return $this->bands;
    }

    /**
     * @param \DateTime $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * Add a band to the single artist (reverse side of the association)
     *
     * @param Band $band
     * @internal
     */
    public function addBand(Band $band)
    {
        $this->bands->add($band);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "{$this->getFirstname()} ".parent::__toString();
    }
}