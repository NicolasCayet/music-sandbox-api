<?php

namespace App\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\CoreBundle\Entity\Song;
use App\AdminBundle\Form\SongType;

/**
 * Controller used to manage songs
 */
class SongController extends Controller
{
    /**
     * Lists all Song entities.
     *
     * @Route("/", name="app_admin_song_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppCoreBundle:Song')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Song entity.
     *
     * @Route("/", name="app_admin_song_create")
     * @Method("POST")
     * @Template("AppAdminBundle:Song:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Song();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('app_admin_song_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Song entity.
     *
     * @param Song $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Song $entity)
    {
        $form = $this->createForm(new SongType(), $entity, array(
            'action' => $this->generateUrl('app_admin_song_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'action.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Song entity.
     *
     * @Route("/new", name="app_admin_song_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Song();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Song entity.
     *
     * @Route("/{id}", name="app_admin_song_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppCoreBundle:Song')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Song entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Song entity.
     *
     * @Route("/{id}/edit", name="app_admin_song_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppCoreBundle:Song')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Song entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Song entity.
    *
    * @param Song $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Song $entity)
    {
        $form = $this->createForm(new SongType(), $entity, array(
            'action' => $this->generateUrl('app_admin_song_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'action.update'));

        return $form;
    }
    /**
     * Edits an existing Song entity.
     *
     * @Route("/{id}", name="app_admin_song_update")
     * @Method("PUT")
     * @Template("AppAdminBundle:Song:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppCoreBundle:Song')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Song entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('app_admin_song_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Song entity.
     *
     * @Route("/{id}", name="app_admin_song_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppCoreBundle:Song')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Song entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('app_admin_song_index'));
    }

    /**
     * Creates a form to delete a Song entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_admin_song_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'action.delete'))
            ->getForm()
        ;
    }
}
