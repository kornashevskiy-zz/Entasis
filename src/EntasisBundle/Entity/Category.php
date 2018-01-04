<?php

namespace EntasisBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="EntasisBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ruName", type="string", length=255)
     */
    private $ruName;

    /**
     * @var string
     * @ORM\Column(name="enName", type="string", length=255)
     */
    private $enName;

    /**
     * @ORM\OneToMany(targetEntity="EntasisBundle\Entity\Product", mappedBy="category", cascade={"persist"}, orphanRemoval=true)
     */
    private $product;

    public function __construct()
    {
        $this->product = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getEnName()
    {
        return $this->enName;
    }

    /**
     * @param string $enName
     */
    public function setEnName($enName)
    {
        $this->enName = $enName;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ruName
     *
     * @param string $ruName
     *
     * @return Category
     */
    public function setRuName($ruName)
    {
        $this->ruName = $ruName;

        return $this;
    }

    /**
     * Get ruName
     *
     * @return string
     */
    public function getRuName()
    {
        return $this->ruName;
    }
}

