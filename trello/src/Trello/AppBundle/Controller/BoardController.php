<?php

namespace Trello\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Trello\AppBundle\Entity\Board;
use Trello\AppBundle\Form\BoardType;

/**
 * Board controller.
 *
 */
class BoardController extends Controller
{

    /**
     * Creates a new Board entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Board();
        $entity->setArchived(false);
        $entity->addUser($this->getUser());
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('trello_app_homepage'));
        }

        return $this->render('TrelloAppBundle:Board:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Board entity.
     *
     * @param Board $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Board $entity)
    {
        $form = $this->createForm(new BoardType(), $entity, array(
            'action' => $this->generateUrl('board_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Board entity.
     *
     */
    public function newAction()
    {
        $entity = new Board();
        $form   = $this->createCreateForm($entity);

        return $this->render('TrelloAppBundle:Board:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Board entity.
     *
     */
    public function showAction($id)
    {
        $entity = $this->getUser()->getBoards()->filter(function($board) use ($id) {
            return $board->getId() == $id;
        })->first();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Board entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TrelloAppBundle:Board:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Board entity.
     *
     */
    public function editAction($id)
    {
        $entity = $this->getUser()->getBoards()->filter(function($board) use ($id) {
            return $board->getId() == $id;
        })->first();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Board entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TrelloAppBundle:Board:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Board entity.
    *
    * @param Board $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Board $entity)
    {
        $form = $this->createForm(new BoardType(), $entity, array(
            'action' => $this->generateUrl('board_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Board entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getUser()->getBoards()->filter(function($board) use ($id) {
            return $board->getId() == $id;
        })->first();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Board entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('board_edit', array('id' => $id)));
        }

        return $this->render('TrelloAppBundle:Board:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Board entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $this->getUser()->getBoards()->filter(function($board) use ($id) {
                return $board->getId() == $id;
            })->first();

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Board entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('trello_app_homepage'));
    }

    /**
     * Creates a form to delete a Board entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('board_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
