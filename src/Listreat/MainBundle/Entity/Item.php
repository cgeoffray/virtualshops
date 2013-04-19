<?php

namespace Listreat\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Item
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Listreat\MainBundle\Entity\ItemRepository")
 */
class Item
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="Listreat\MainBundle\Entity\Image", cascade={"persist", "remove"}, mappedBy="item")
     */
    private $images;

    /**
     * @var string
     *
     * @ORM\Column(name="link", type="string", length=255)
     */
    private $link;
    
    /**
     * @ORM\ManyToOne(targetEntity="Listreat\MainBundle\Entity\Shop", inversedBy="items")
     * @ORM\JoinColumn(nullable=true)
     */
    private $shop;

    public function __toString() {
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
     * @return Item
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
     * @return Item
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
     * Set link
     *
     * @param string $link
     * @return Item
     */
    public function setLink($link)
    {
        $this->link = $link;
    
        return $this;
    }

    /**
     * Get link
     *
     * @return string 
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set shop
     *
     * @param \Listreat\MainBundle\Entity\Shop $shop
     * @return Item
     */
    public function setShop(\Listreat\MainBundle\Entity\Shop $shop = null)
    {
        $this->shop = $shop;
    
        return $this;
    }

    /**
     * Get shop
     *
     * @return \Listreat\MainBundle\Entity\Shop 
     */
    public function getShop()
    {
        return $this->shop;
    }
    
    function asMobileObject()
    {
        $result = array();
        $methods = get_class_methods($this);
        foreach($methods as $method) {
            if ('get' == substr($method, 0, 3)  && !in_array(substr($method, 3), array('Shop'))) {
                $result[strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/',"_$1", substr($method, 3)))] = $this->$method();
            }
        }
        return $result;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add images
     *
     * @param \Listreat\MainBundle\Entity\Image $images
     * @return Item
     */
    public function addImage(\Listreat\MainBundle\Entity\Image $images)
    {
        $this->images[] = $images;
    
        return $this;
    }

    /**
     * Remove images
     *
     * @param \Listreat\MainBundle\Entity\Image $images
     */
    public function removeImage(\Listreat\MainBundle\Entity\Image $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }
}