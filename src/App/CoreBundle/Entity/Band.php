<?php

namespace App\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Band : band of single artists
 *
 * @package App\CoreBundle\Entity
 *
 * @ORM\Table(name="artists_band")
 * @ORM\Entity
 */
class Band extends Artist {
    /**
     * @var \DateTime $formedDate
     *
     * @ORM\Column(name="formed_date", type="date", nullable=true)
     */
    protected $formedDate;
    /**
     * @var ArrayCollection $members Which single artists are members of the band
     *
     * @ORM\ManyToMany(targetEntity="Single", inversedBy="bands")
     * @ORM\JoinTable(name="bands_singles")
     */
    protected $members;

    public function __construct()
    {
        $this->members = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getFormedDate()
    {
        return $this->formedDate;
    }

    /**
     * @return ArrayCollection
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param mixed $formedDate
     */
    public function setFormedDate($formedDate)
    {
        $this->formedDate = $formedDate;
    }

    /**
     * Add a member to the band (owning side of the association)
     *
     * @param Single $member
     */
    public function addMember(Single $member)
    {
        $member->addBand($this);
        $this->members->add($member);
    }
}