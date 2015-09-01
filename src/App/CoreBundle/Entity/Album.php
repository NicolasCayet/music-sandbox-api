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
 * @ORM\Table(name="albums")
 * @ORM\Entity
 */
class Album {
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
     * @var \DateTime $releaseDate
     *
     * @ORM\Column(name="release_date", type="date", nullable=false)
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
     * @var ArrayCollection $artists Artist(s) who realized the album
     *
     * @ORM\ManyToMany(targetEntity="Artist", inversedBy="albums")
     * @ORM\JoinTable(name="albums_artists")
     */
    protected $artists;
    /**
     * @var ArrayCollection $songs
     *
     * @ORM\OneToMany(targetEntity="Song", mappedBy="album")
     */
    protected $songs;
    /**
     * @var int $duration Total duration of the album in seconds. Calculated property (use getDuration())
     */
    protected $duration;

    public function __construct()
    {
        $this->artists = new ArrayCollection();
        $this->songs = new ArrayCollection();
    }

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
     * @return ArrayCollection
     */
    public function getArtists()
    {
        return $this->artists;
    }

    /**
     * @return ArrayCollection
     */
    public function getSongs()
    {
        return $this->songs;
    }

    /**
     * @return int
     */
    public function getDuration()
    {
        $total = 0;
        foreach ($this->getSongs() as $song) {
            $total += $song->getDuration();
        }

        return $total;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param \DateTime $releaseDate
     */
    public function setReleaseDate($releaseDate)
    {
        $this->releaseDate = $releaseDate;
    }

    /**
     * Add an artist who realized the album (owning side of the association)
     *
     * @param Artist $artist
     */
    public function addArtist(Artist $artist)
    {
        $artist->addAlbum($this);
        $this->artists->add($artist);
    }

    /**
     * @param Song $song
     * @internal
     */
    public function addSong(Song $song)
    {
        $this->songs->add($song);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getTitle();
    }
}