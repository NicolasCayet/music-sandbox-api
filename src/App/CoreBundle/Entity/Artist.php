<?php

namespace App\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Class Artist : Artist producing album and performing song.
 *
 * Parent class for band and single
 *
 * @package App\CoreBundle\Entity
 *
 * @ORM\Table(name="artists")
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"band" = "Band", "single" = "Single"})
 */
abstract class Artist {
    /**
     * @var int $id
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    /**
     * @var string $name
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $name;
    /**
     * @var string $description
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;
    /**
     * @var int $createdAt
     *
     * @ORM\Column(name="created_at", type="integer", nullable=false)
     * @Gedmo\Timestampable(on="create")
     */
    protected $createdAt;
    /**
     * @var int $updatedAt
     *
     * @ORM\Column(name="updated_at", type="integer", nullable=false)
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;
    /**
     * @var ArrayCollection $songs
     *
     * @ORM\OneToMany(targetEntity="Song", mappedBy="performer", cascade={"remove"})
     */
    protected $songs;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return int
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $className = explode('\\', get_class($this));

        return "{$this->getName()} (".array_pop($className).")";
    }
}