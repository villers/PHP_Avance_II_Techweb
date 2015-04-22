<?php

namespace Trello\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Card
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Card
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    public $description;


    /**
     * @ORM\ManyToOne(targetEntity="Liste", inversedBy="card", cascade={"remove"})
     */
    public $liste;

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
     * @return Card
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
     * @return Card
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
     * Set description
     *
     * @param string $description
     * @return Card
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
     * Set liste
     *
     * @param \Trello\AppBundle\Entity\Liste $liste
     * @return Card
     */
    public function setListe(\Trello\AppBundle\Entity\Liste $liste = null)
    {
        $this->liste = $liste;

        return $this;
    }

    /**
     * Get liste
     *
     * @return \Trello\AppBundle\Entity\Liste 
     */
    public function getListe()
    {
        return $this->liste;
    }
}
