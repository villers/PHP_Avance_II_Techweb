<?php

namespace Trello\AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Trello\AppBundle\Entity\Card;
use Trello\AppBundle\Form\CardType;

/**
 * Card controller.
 *
 */
class CardController extends Controller
{

    /**
     * Lists all Card entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TrelloAppBundle:Card')->findAll();

        return $this->render('TrelloAppBundle:Card:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Card entity.
     *
     */
    public function createAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $list = $em->getRepository('TrelloAppBundle:Liste')->find($id);

        $entity = new Card();
        $entity->setListe($list);
        $entity->setArchived(false);
        $entity->setTitle($request->request->get('title'));
        $entity->setDescription($request->request->get('description'));

        $em->persist($entity);
        $em->flush();

        return new JsonResponse(get_object_vars($entity));
    }

    /**
     * Edits an existing Card entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TrelloAppBundle:Card')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Card entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('card_edit', array('id' => $id)));
        }

        return $this->render('TrelloAppBundle:Card:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Card entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('TrelloAppBundle:Card')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Card entity.');
        }

        $em->remove($entity);
        $em->flush();

        return new JsonResponse([]);
    }
}
