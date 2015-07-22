<?php

namespace App\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use App\CoreBundle\Entity\Single;
use App\AdminBundle\Form\SingleType;

/**
 * Controller used to manage artist of type Single (single person)
 */
class SingleController extends Controller
{

    /**
     * Lists all Single entities.
     *
     * @Route("/", name="app_admin_single_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppCoreBundle:Single')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Single entity.
     *
     * @Route("/", name="app_admin_single_create")
     * @Method("POST")
     * @Template("AppAdminBundle:Single:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Single();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('app_admin_single_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Single entity.
     *
     * @param Single $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Single $entity)
    {
        $form = $this->createForm(new SingleType(), $entity, array(
            'action' => $this->generateUrl('app_admin_single_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'action.create'));

        return $form;
    }

    /**
     * Displays a form to create a new Single entity.
     *
     * @Route("/new", name="app_admin_single_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Single();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Single entity.
     *
     * @Route("/{id}", name="app_admin_single_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppCoreBundle:Single')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Single entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Single entity.
     *
     * @Route("/{id}/edit", name="app_admin_single_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppCoreBundle:Single')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Single entity.');
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
    * Creates a form to edit a Single entity.
    *
    * @param Single $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Single $entity)
    {
        $form = $this->createForm(new SingleType(), $entity, array(
            'action' => $this->generateUrl('app_admin_single_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'action.update'));

        return $form;
    }
    /**
     * Edits an existing Single entity.
     *
     * @Route("/{id}", name="app_admin_single_update")
     * @Method("PUT")
     * @Template("AppAdminBundle:Single:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppCoreBundle:Single')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Single entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('app_admin_single_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Single entity.
     *
     * @Route("/{id}", name="app_admin_single_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppCoreBundle:Single')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Single entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('app_admin_single_index'));
    }

    /**
     * Creates a form to delete a Single entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('app_admin_single_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'action.delete'))
            ->getForm()
        ;
    }
}
