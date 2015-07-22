<?php

namespace App\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Band : band of single artists
 *
 * @package App\CoreBundle\Entity
 *
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
     * @return mixed
     */
    public function getFormedDate()
    {
        return $this->formedDate;
    }

    /**
     * @param mixed $formedDate
     */
    public function setFormedDate($formedDate)
    {
        $this->formedDate = $formedDate;
    }

}