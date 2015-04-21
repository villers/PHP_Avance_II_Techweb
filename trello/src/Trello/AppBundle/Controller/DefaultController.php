<?php

namespace Trello\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TrelloAppBundle:Default:index.html.twig');
    }
}
