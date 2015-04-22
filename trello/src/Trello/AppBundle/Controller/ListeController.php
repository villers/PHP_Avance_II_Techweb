<?php

namespace Trello\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Trello\AppBundle\Entity\Liste;
use Trello\AppBundle\Form\ListeType;

/**
 * Liste controller.
 *
 */
class ListeController extends Controller
{

    /**
     * Lists all Liste entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TrelloAppBundle:Liste')->findAll();

        return $this->render('TrelloAppBundle:Liste:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Liste entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Liste();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('liste_show', array('id' => $entity->getId())));
        }

        return $this->render('TrelloAppBundle:Liste:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Liste entity.
     *
     * @param Liste $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Liste $entity)
    {
        $form = $this->createForm(new ListeType(), $entity, array(
            'action' => $this->generateUrl('liste_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Liste entity.
     *
     */
    public function newAction()
    {
        $entity = new Liste();
        $form   = $this->createCreateForm($entity);

        return $this->render('TrelloAppBundle:Liste:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Liste entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TrelloAppBundle:Liste')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Liste entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TrelloAppBundle:Liste:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Liste entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TrelloAppBundle:Liste')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Liste entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TrelloAppBundle:Liste:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Liste entity.
    *
    * @param Liste $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Liste $entity)
    {
        $form = $this->createForm(new ListeType(), $entity, array(
            'action' => $this->generateUrl('liste_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Liste entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TrelloAppBundle:Liste')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Liste entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('liste_edit', array('id' => $id)));
        }

        return $this->render('TrelloAppBundle:Liste:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Liste entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TrelloAppBundle:Liste')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Liste entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('liste'));
    }

    /**
     * Creates a form to delete a Liste entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('liste_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
