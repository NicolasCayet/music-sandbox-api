<?php

namespace App\CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Entity representing a song
 *
 * @package App\CoreBundle\Entity
 *
 * @ORM\Table(name="songs")
 * @ORM\Entity
 */
class Song {
    /**
     * @var int $id
     *
     * @ORM\Column(type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
    /**
     * @var string $title
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    protected $title;
    /**
     * @var int $duration Duration in seconds
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    protected $duration;
    /**
     * @var string $dailymotionUrl URL to the song on http://www.dailymotion.com/
     *
     * @ORM\Column(type="text", nullable=true)
     */
    protected $dailymotionUrl;
    /**
     * @var \DateTime $releaseDate
     *
     * @ORM\Column(name="release_date", type="date", nullable=true)
     */
    protected $releaseDate;
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
     * @var ArrayCollection $performers
     *
     * @ORM\ManyToMany(targetEntity="Artist", inversedBy="songs")
     * @ORM\JoinTable(name="artists_performers")
     */
    protected $performers;
    /**
     * @var Album $album
     *
     * @ORM\ManyToOne(targetEntity="Album", inversedBy="songs")
     */
    protected $album;

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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @return string
     */
    public function getDailymotionUrl()
    {
        return $this->dailymotionUrl;
    }

    /**
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
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
     * @return Album
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param int $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @param string $dailymotionUrl
     */
    public function setDailymotionUrl($dailymotionUrl)
    {
        $this->dailymotionUrl = $dailymotionUrl;
    }

    /**
     * @param \DateTime $releaseDate
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return ArrayCollection
     */
    public function getPerformers()
    {
        return $this->performers;
    }

    /**
     * @param Artist $performer
     */
    public function addPerformer(Artist $performer)
    {
        $performer->addSong($this);
        $this->performers->add($performer);
    }

    /**
     * @param Album $album
     */
    public function setAlbum(Album $album)
    {
        $album->addSong($this);
        $this->album = $album;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}