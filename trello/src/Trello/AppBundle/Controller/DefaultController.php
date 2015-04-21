<?php

namespace Trello\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $boards = $em->getRepository('TrelloAppBundle:Board')->findByUser($this->getUser());
        return $this->render('TrelloAppBundle:Default:index.html.twig', compact('boards'));
    }

    public function showAction()
    {

    }

}
