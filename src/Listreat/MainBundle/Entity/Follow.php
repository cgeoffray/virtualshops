<?php

namespace Listreat\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Follow
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Listreat\MainBundle\Entity\FollowRepository")
 */
class Follow
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
     * @var date
     *
     * @ORM\Column(name="lastvisit", type="date")
     */
    private $lastVisit;

    /**
     * @ORM\ManyToOne(targetEntity="Listreat\UserBundle\Entity\User", inversedBy="fShops")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Listreat\MainBundle\Entity\Shop", inversedBy="followers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $shop;
    
    
    public function __construct()
    {
        $this->lastVisit = new \DateTime('now');
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
     * Set lastVisit
     *
     * @param \DateTime $lastVisit
     * @return Follow
     */
    public function setLastVisit($lastVisit)
    {
        $this->lastVisit = $lastVisit;
    
        return $this;
    }

    /**
     * Get lastVisit
     *
     * @return \DateTime 
     */
    public function getLastVisit()
    {
        return $this->lastVisit;
    }

    /**
     * Set user
     *
     * @param \Listreat\UserBundle\Entity\User $user
     * @return Follow
     */
    public function setUser(\Listreat\UserBundle\Entity\User $user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Listreat\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set shop
     *
     * @param \Listreat\MainBundle\Entity\Shop $shop
     * @return Follow
     */
    public function setShop(\Listreat\MainBundle\Entity\Shop $shop)
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
            if ('get' == substr($method, 0, 3) && !in_array(substr($method, 3), array('User', 'Shop'))) {
                $result[strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/',"_$1", substr($method, 3)))] = $this->$method();
            }
        }
        foreach ($this->items as $a)
          $result['items'][$a->getTitle()] = $a->asMobileObject();
        $result['description'] = nl2br($this->getDescription());
        $result['creator'] = $this->getCreator()->asShopMobileObject();
        return $result;
    }
}