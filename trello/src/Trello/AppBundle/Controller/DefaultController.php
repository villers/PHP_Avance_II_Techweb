<?php

namespace Trello\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Trello\UserBundle\Entity\User;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $boards = $this->getUser()->getBoards();


        foreach($boards as $board){
            $board->counter = 0;
            $nbCard = 0;
            foreach($board->getListe() as $liste){
                foreach($liste->getCard() as $card){
                    $nbCard++;
                    if($card->getArchived())
                        $board->counter++;
                }
            }
            $board->counter = round(($board->counter / $nbCard) * 100);
        }
        return $this->render('TrelloAppBundle:Default:index.html.twig', compact('boards'));
    }

    public function showAction()
    {

    }

}
