<?php

namespace Listreat\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use DoctrineExtensions\Taggable\Taggable;

/**
 * Shop
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Listreat\MainBundle\Entity\ShopRepository")
 */
class Shop
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;
    
    /**
     * @ORM\OneToMany(targetEntity="Listreat\MainBundle\Entity\Item", cascade={"persist", "remove"}, mappedBy="shop")
     */
    private $items;
    
    /**
     * @ORM\ManyToOne(targetEntity="Listreat\UserBundle\Entity\User", inversedBy="myshops")
     * @ORM\JoinColumn(nullable=true)
     */
    private $creator;
    
    /**
     * @ORM\OneToMany(targetEntity="Listreat\MainBundle\Entity\Follow", mappedBy="shop")
     */
    private $followers;
    
    /**
     * @ORM\ManyToMany(targetEntity="Listreat\MainBundle\Entity\Tag", cascade={"persist"})
     */
    private $tags;

    public function __toString() {
      return $this->name;
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
     * Set name
     *
     * @param string $name
     * @return Shop
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Shop
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
     * Constructor
     */
    
    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
        $this->followers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add item
     *
     * @param \Listreat\MainBundle\Entity\Item $item
     * @return Shop
     */
    public function addItem(\Listreat\MainBundle\Entity\Item $item)
    {
        $this->items[] = $item;
        $item->setShop($this);
    
        return $this;
    }

    /**
     * Remove item
     *
     * @param \Listreat\MainBundle\Entity\Item $item
     */
    public function removeItem(\Listreat\MainBundle\Entity\Item $item)
    {
        $this->items->removeElement($item);
    }

    /**
     * Get items
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Set creator
     *
     * @param \Listreat\UserBundle\Entity\User $creator
     * @return Shop
     */
    public function setCreator(\Listreat\UserBundle\Entity\User $creator = null)
    {
        $this->creator = $creator;
    
        return $this;
    }

    /**
     * Get creator
     *
     * @return \Listreat\UserBundle\Entity\User 
     */
    public function getCreator()
    {
        return $this->creator;
    }
    
    function asMobileObject()
    {
        $result = array();
        $methods = get_class_methods($this);
        foreach($methods as $method) {
            if ('get' == substr($method, 0, 3) && !in_array(substr($method, 3), array('Items', 'Creator'))) {
                $result[strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/',"_$1", substr($method, 3)))] = $this->$method();
            }
        }
        foreach ($this->items as $a)
          $result['items'][$a->getTitle()] = $a->asMobileObject();
        $result['description'] = nl2br($this->getDescription());
        $result['creator'] = $this->getCreator()->asShopMobileObject();
        return $result;
    }

    /**
     * Add followers
     *
     * @param \Listreat\MainBundle\Entity\Follow $followers
     * @return Shop
     */
    public function addFollower(\Listreat\MainBundle\Entity\Follow $followers)
    {
        $this->followers[] = $followers;
    
        return $this;
    }

    /**
     * Remove followers
     *
     * @param \Listreat\MainBundle\Entity\Follow $followers
     */
    public function removeFollower(\Listreat\MainBundle\Entity\Follow $followers)
    {
        $this->followers->removeElement($followers);
    }

    /**
     * Get followers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFollowers()
    {
        return $this->followers;
    }

    /**
     * Add tags
     *
     * @param \Listreat\MainBundle\Entity\Tag $tags
     * @return Shop
     */
    public function addTag(\Listreat\MainBundle\Entity\Tag $tags)
    {
        $this->tags[] = $tags;
    
        return $this;
    }

    /**
     * Remove tags
     *
     * @param \Listreat\MainBundle\Entity\Tag $tags
     */
    public function removeTag(\Listreat\MainBundle\Entity\Tag $tags)
    {
        $this->tags->removeElement($tags);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTags()
    {
        $this->tags = $this->tags ?: new ArrayCollection();

        return $this->tags;
    }

    public function getTaggableType()
    {
        return 'shop';
    }

    public function getTaggableId()
    {
        return $this->getId();
    }
}