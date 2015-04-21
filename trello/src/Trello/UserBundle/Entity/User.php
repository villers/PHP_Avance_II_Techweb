<?php

namespace Trello\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="\Trello\AppBundle\Entity\Board", mappedBy="user")
     */
    protected $board;

    public function __construct()
    {
        parent::__construct();
        $this->board = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add board
     *
     * @param \Trello\AppBundle\Entity\Board $board
     * @return User
     */
    public function addBoard(\Trello\AppBundle\Entity\Board $board)
    {
        $this->board[] = $board;

        return $this;
    }

    /**
     * Remove board
     *
     * @param \Trello\AppBundle\Entity\Board $board
     */
    public function removeBoard(\Trello\AppBundle\Entity\Board $board)
    {
        $this->board->removeElement($board);
    }

    /**
     * Get board
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBoard()
    {
        return $this->board;
    }
}
