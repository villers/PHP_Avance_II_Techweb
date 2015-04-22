<?php

namespace Trello\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * List
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Liste
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
     * @var boolean
     *
     * @ORM\Column(name="archived", type="boolean")
     */
    public $archived;

    /**
     * @ORM\ManyToOne(targetEntity="Board", inversedBy="liste", cascade={"remove"})
     */
    public $board;

    /**
     * @ORM\OneToMany(targetEntity="Card", mappedBy="liste", cascade={"remove"})
     */
    public $card;

    public function __construct()
    {
        $this->card = new ArrayCollection();
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
     * @return Liste
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
     * Set archived
     *
     * @param boolean $archived
     * @return Liste
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
     * Set board
     *
     * @param \Trello\AppBundle\Entity\Board $board
     * @return Liste
     */
    public function setBoard(\Trello\AppBundle\Entity\Board $board = null)
    {
        $this->board = $board;

        return $this;
    }

    /**
     * Get board
     *
     * @return \Trello\AppBundle\Entity\Board 
     */
    public function getBoard()
    {
        return $this->board;
    }

    /**
     * Add card
     *
     * @param \Trello\AppBundle\Entity\Card $card
     * @return Liste
     */
    public function addCard(\Trello\AppBundle\Entity\Card $card)
    {
        $this->card[] = $card;

        return $this;
    }

    /**
     * Remove card
     *
     * @param \Trello\AppBundle\Entity\Card $card
     */
    public function removeCard(\Trello\AppBundle\Entity\Card $card)
    {
        $this->card->removeElement($card);
    }

    /**
     * Get card
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCard()
    {
        return $this->card;
    }
}
