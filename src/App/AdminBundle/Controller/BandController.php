<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\CoreBundle\Entity\Band;
use App\AdminBundle\Form\BandType;

/**
 * Controller used to manage band (group of artists)
 */
class BandController extends Controller
{
    /**
     * Lists all Band entities.
     *
     * @Route("/", name="app_admin_band_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppCoreBundle:Band')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Band entity.
     *
     * @Route("/", name="app_admin_band_create")
     * @Method("POST")
     * @Template("AppAdminBundle:Band:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Band();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('app_admin_band_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Band entity.
     *
     * @param Band $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Band $entity)
    {
        $form = $this->createForm(new BandType(), $entity, array(
            'action' => $this->generateUrl('app_admin_band_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'action.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Band entity.
     *
     * @Route("/new", name="app_admin_band_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Band();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Band entity.
     *
     * @Route("/{id}", name="app_admin_band_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppCoreBundle:Band')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Band entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Band entity.
     *
     * @Route("/{id}/edit", name="app_admin_band_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppCoreBundle:Band')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Band entity.');
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
    * Creates a form to edit a Band entity.
    *
    * @param Band $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Band $entity)
    {
        $form = $this->createForm(new BandType(), $entity, array(
            'action' => $this->generateUrl('app_admin_band_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'action.update'));

        return $form;
    }
    /**
     * Edits an existing Band entity.
     *
     * @Route("/{id}", name="app_admin_band_update")
     * @Method("PUT")
     * @Template("AppAdminBundle:Band:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppCoreBundle:Band')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Band entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('app_admin_band_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Band entity.
     *
     * @Route("/{id}", name="app_admin_band_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppCoreBundle:Band')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Band entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('app_admin_band_index'));
    }

    /**
     * Creates a form to delete a Band entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_admin_band_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'action.delete'))
            ->getForm()
        ;
    }
}
