<?php

namespace Trello\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Board
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Board
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    public $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    public $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="archived", type="boolean")
     */
    public $archived;

    /**
     * @ORM\OneToMany(targetEntity="Liste", mappedBy="board", cascade={"remove"})
     */
    public $liste;

    /**
     * @ORM\ManyToMany(targetEntity="\Trello\UserBundle\Entity\User", inversedBy="boards")
     **/
    public $users;

    public function __construct()
    {
        $this->liste = new ArrayCollection();
        $this->users = new ArrayCollection();
    }

    public function __toString(){
        return $this->title;
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
     * Set title
     *
     * @param string $title
     * @return Board
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Board
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set archived
     *
     * @param boolean $archived
     * @return Board
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;

        return $this;
    }

    /**
     * Get archived
     *
     * @return boolean 
     */
    public function getArchived()
    {
        return $this->archived;
    }

    /**
     * Add liste
     *
     * @param \Trello\AppBundle\Entity\Liste $liste
     * @return Board
     */
    public function addListe(\Trello\AppBundle\Entity\Liste $liste)
    {
        $this->liste[] = $liste;

        return $this;
    }

    /**
     * Remove liste
     *
     * @param \Trello\AppBundle\Entity\Liste $liste
     */
    public function removeListe(\Trello\AppBundle\Entity\Liste $liste)
    {
        $this->liste->removeElement($liste);
    }

    /**
     * Get liste
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getListe()
    {
        return $this->liste;
    }


    /**
     * Add users
     *
     * @param \Trello\UserBundle\Entity\User $users
     * @return Board
     */
    public function addUser(\Trello\UserBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove users
     *
     * @param \Trello\UserBundle\Entity\User $users
     */
    public function removeUser(\Trello\UserBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}
