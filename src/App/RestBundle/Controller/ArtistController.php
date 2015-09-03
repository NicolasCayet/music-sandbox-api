<?php

namespace App\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArtistController extends Controller
{
    public function getArtistsAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppCoreBundle:Artist')->findAll();

        return $entities;
    }

    public function getArtistAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppCoreBundle:Artist')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException();
        }

        return $entity;
    }
}
