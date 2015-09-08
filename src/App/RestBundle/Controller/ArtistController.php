<?php

namespace App\RestBundle\Controller;

use App\CoreBundle\Entity\Artist;
use App\CoreBundle\Entity\Band;
use App\CoreBundle\Entity\Single;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;

class ArtistController extends Controller
{
    /**
     * @Rest\View(serializerGroups={"Default", "Common_artist_details", "Single_artist_details"})
     *
     * @param $artistId
     * @return Single
     */
    public function getSingleAction($artistId)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppCoreBundle:Single')->find($artistId);

        if (!$entity) {
            throw $this->createNotFoundException();
        }

        return $entity;
    }

    /**
     * @Rest\View(serializerGroups={"Default", "Common_artist_details", "Band_artist_details"})
     *
     * @param $artistId
     * @return Band
     */
    public function getBandAction($artistId)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppCoreBundle:Band')->find($artistId);

        if (!$entity) {
            throw $this->createNotFoundException();
        }

        return $entity;
    }

    /**
     * @Rest\View(serializerGroups={"Default", "Common_artist_details"})
     *
     * @return mixed
     */
    public function getArtistsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppCoreBundle:Artist')->findAll();

        return $entities;
    }

    /**
     * @Rest\View(serializerGroups={"Default", "Common_artist_details"})
     *
     * @param integer $artistId
     * @return Artist
     */
    public function getArtistAction($artistId)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppCoreBundle:Artist')->find($artistId);

        if (!$entity) {
            throw $this->createNotFoundException();
        }

        return $entity;
    }
}
