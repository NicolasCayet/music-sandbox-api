<?php

namespace App\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;

class ArtistChildrenController extends Controller
{
    /**
     * @Rest\View(serializerGroups={"Default","Song_details"})
     *
     * @return mixed
     */
    public function getSongsAction($artistId)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppCoreBundle:Artist')->find($artistId);
        if (!$entity) {
            throw $this->createNotFoundException("Artist not found");
        }

        return $entity->getSongs();
    }

    /**
     * @Rest\View(serializerGroups={"Default","Album_details"})
     *
     * @return mixed
     */
    public function getAlbumsAction($artistId)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppCoreBundle:Artist')->find($artistId);
        if (!$entity) {
            throw $this->createNotFoundException("Artist not found");
        }

        return $entity->getAlbums();
    }
}
