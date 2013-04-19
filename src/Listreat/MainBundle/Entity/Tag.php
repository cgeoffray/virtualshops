<?php

namespace Listreat\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tag
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Listreat\MainBundle\Entity\TagRepository")
 */
class Tag
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
     * @ORM\ManyToMany(targetEntity="Listreat\MainBundle\Entity\Shop", cascade={"persist"})
     */
    private $shops;


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
     * @return Tag
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
     * Constructor
     */
    public function __construct()
    {
        $this->shops = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add shops
     *
     * @param \Listreat\MainBundle\Entity\Shop $shops
     * @return Tag
     */
    public function addShop(\Listreat\MainBundle\Entity\Shop $shops)
    {
        $this->shops[] = $shops;
    
        return $this;
    }

    /**
     * Remove shops
     *
     * @param \Listreat\MainBundle\Entity\Shop $shops
     */
    public function removeShop(\Listreat\MainBundle\Entity\Shop $shops)
    {
        $this->shops->removeElement($shops);
    }

    /**
     * Get shops
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getShops()
    {
        return $this->shops;
    }
}