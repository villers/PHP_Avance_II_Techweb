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
     * @ORM\ManyToMany(targetEntity="\Trello\AppBundle\Entity\Board", mappedBy="users")
     **/
    protected $boards;

    public function __construct()
    {
        parent::__construct();
        $this->boards = new ArrayCollection();
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
     * Add boards
     *
     * @param \Trello\AppBundle\Entity\Board $boards
     * @return User
     */
    public function addBoard(\Trello\AppBundle\Entity\Board $boards)
    {
        $this->boards[] = $boards;

        return $this;
    }

    /**
     * Remove boards
     *
     * @param \Trello\AppBundle\Entity\Board $boards
     */
    public function removeBoard(\Trello\AppBundle\Entity\Board $boards)
    {
        $this->boards->removeElement($boards);
    }

    /**
     * Get boards
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBoards()
    {
        return $this->boards;
    }
}
