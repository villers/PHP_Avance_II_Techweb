<?php

namespace Trello\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    protected $slug;

    /**
     * @var boolean
     *
     * @ORM\Column(name="archived", type="boolean")
     */
    protected $archived;

    /**
     * @ORM\OneToMany(targetEntity="Liste", mappedBy="board")
     */
    protected $liste;

    /**
     * @ORM\ManyToOne(targetEntity="\Trello\UserBundle\Entity\User", inversedBy="board")
     */
    protected $user;

    public function __construct()
    {
        $this->liste = new ArrayCollection();
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
     * Set slug
     *
     * @param string $slug
     * @return Board
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
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
     * Set user
     *
     * @param \Trello\UserBundle\Entity\User $user
     * @return Board
     */
    public function setUser(\Trello\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Trello\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
