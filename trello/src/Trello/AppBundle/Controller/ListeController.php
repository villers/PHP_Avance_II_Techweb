<?php

namespace Trello\AppBundle\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;
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
    public function createAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $board = $em->getRepository('TrelloAppBundle:Board')->find($id);

        $entity = new Liste();
        $entity->setBoard($board);
        $entity->setArchived(false);
        $entity->setTitle($request->request->get('title'));

        $em->persist($entity);
        $em->flush();

        return new JsonResponse(get_object_vars($entity));
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

        $em->flush();
        return $this->redirect($this->generateUrl('liste_edit', array('id' => $id)));

    }
    /**
     * Deletes a Liste entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('TrelloAppBundle:Card')->findByListe($id);
        foreach($entity as $row){
            $em->remove($row);
            $em->flush();
        }


        $entity = $em->getRepository('TrelloAppBundle:Liste')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Liste entity.');
        }

        $em->remove($entity);
        $em->flush();

        return new JsonResponse([]);
    }

}
