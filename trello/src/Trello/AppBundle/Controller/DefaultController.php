<?php

namespace Trello\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Trello\UserBundle\Entity\User;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $boards = $this->getUser()->getBoards();
        return $this->render('TrelloAppBundle:Default:index.html.twig', compact('boards'));
    }

    public function showAction()
    {

    }

}
