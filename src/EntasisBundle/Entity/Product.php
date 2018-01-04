<?php

namespace EntasisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="EntasisBundle\Repository\ProductRepository")
 */
class Product
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
     *
     * @ORM\Column(name="enName", type="string", length=255)
     */
    private $enName;

    /**
     * @var string
     *
     * @ORM\Column(name="ruDescription", type="text", nullable=true)
     */
    private $ruDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="enDescription", type="text", nullable=true)
     */
    private $enDescription;

    /**
     * @ORM\ManyToOne(targetEntity="EntasisBundle\Entity\Category", inversedBy="product", cascade={"persist"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="titleImage", type="string", length=255)
     */
    private $titleImage;

    /**
     * @var string
     *
     * @ORM\Column(name="images", type="text", nullable=true)
     */
    private $images;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="create_at", type="datetime")
     */
    private $createAt;

    private $hiddenImage;

    private $hiddenImages;

    /**
     * @return mixed
     */
    public function getHiddenImage()
    {
        return $this->hiddenImage;
    }

    /**
     * @param mixed $hiddenImage
     */
    public function setHiddenImage($hiddenImage)
    {
        $this->hiddenImage = $hiddenImage;
    }

    /**
     * @return mixed
     */
    public function getHiddenImages()
    {
        return $this->hiddenImages;
    }

    /**
     * @param mixed $hiddenImages
     */
    public function setHiddenImages($hiddenImages)
    {
        $this->hiddenImages = $hiddenImages;
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
     * @return Product
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

    /**
     * Set enName
     *
     * @param string $enName
     *
     * @return Product
     */
    public function setEnName($enName)
    {
        $this->enName = $enName;

        return $this;
    }

    /**
     * Get enName
     *
     * @return string
     */
    public function getEnName()
    {
        return $this->enName;
    }

    /**
     * Set ruDescription
     *
     * @param string $ruDescription
     *
     * @return Product
     */
    public function setRuDescription($ruDescription)
    {
        $this->ruDescription = $ruDescription;

        return $this;
    }

    /**
     * Get ruDescription
     *
     * @return string
     */
    public function getRuDescription()
    {
        return $this->ruDescription;
    }

    /**
     * Set enDescription
     *
     * @param string $enDescription
     *
     * @return Product
     */
    public function setEnDescription($enDescription)
    {
        $this->enDescription = $enDescription;

        return $this;
    }

    /**
     * Get enDescription
     *
     * @return string
     */
    public function getEnDescription()
    {
        return $this->enDescription;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Product
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set titleImage
     *
     * @param string $titleImage
     *
     * @return Product
     */
    public function setTitleImage($titleImage)
    {
        $this->titleImage = $titleImage;

        return $this;
    }

    /**
     * Get titleImage
     *
     * @return string
     */
    public function getTitleImage()
    {
        return $this->titleImage;
    }

    /**
     * Set images
     *
     * @param string $images
     *
     * @return Product
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images
     *
     * @return string
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set createAt
     *
     * @param \DateTime $createAt
     *
     * @return Product
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;

        return $this;
    }

    /**
     * Get createAt
     *
     * @return \DateTime
     */
    public function getCreateAt()
    {
        return $this->createAt;
    }
}

