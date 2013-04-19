<?php

namespace Listreat\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Listreat\UserBundle\Entity\User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Listreat\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string $firstname
     *
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @var string $lastname
     *
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @var \DateTime $bday
     *
     * @ORM\Column(name="bday", type="date", nullable=true)
     */
    private $bday;
    
    /**
     * @ORM\OneToMany(targetEntity="Listreat\MainBundle\Entity\Shop", mappedBy="creator")
     */
    private $myshops;
    
    /**
     * @ORM\OneToMany(targetEntity="Listreat\MainBundle\Entity\Follow", mappedBy="user")
     */
    private $fShops;
    
    /**
     * @ORM\OneToMany(targetEntity="Listreat\UserBundle\Entity\Friend", mappedBy="user")
     */
    private $friends;
    
    /**
     * @ORM\OneToMany(targetEntity="Listreat\UserBundle\Entity\Friend", mappedBy="friend")
     */
    private $visibility;

    public function __toString() {
      return $this->username;
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
     * Set firstname
     *
     * @param string $firstname
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set bday
     *
     * @param \DateTime $bday
     * @return User
     */
    public function setBday($bday)
    {
        $this->bday = $bday;
    
        return $this;
    }

    /**
     * Get bday
     *
     * @return \DateTime 
     */
    public function getBday()
    {
        return $this->bday;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->myshops = new \Doctrine\Common\Collections\ArrayCollection();
        $this->fShops = new \Doctrine\Common\Collections\ArrayCollection();
        $this->friends = new \Doctrine\Common\Collections\ArrayCollection();
        $this->visibility = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add myshop
     *
     * @param \Listreat\MainBundle\Entity\Shop $myshop
     * @return User
     */
    public function addMyshop(\Listreat\MainBundle\Entity\Shop $myshop)
    {
        $this->myshops[] = $myshop;
    
        return $this;
    }

    /**
     * Remove myshop
     *
     * @param \Listreat\MainBundle\Entity\Shop $myshop
     */
    public function removeMyshop(\Listreat\MainBundle\Entity\Shop $myshop)
    {
        $this->myshops->removeElement($myshop);
    }

    /**
     * Get myshops
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMyshops()
    {
        return $this->myshops;
    }
    
    function asMobileObject()
    {
        $result = array();
        $methods = get_class_methods($this);
        foreach($methods as $method) {
            if ('get' == substr($method, 0, 3)  && !in_array(substr($method, 3), array('Myshops'))) {
                $result[strtolower(preg_replace('/(?<=\\w)(?=[A-Z])/',"_$1", substr($method, 3)))] = $this->$method();
            }
        }
        return $result;
    }
    
    function asShopMobileObject()
    {
        $result = array();
        
        $result['id'] = $this->getId();
        $result['username'] = $this->getUsername();
        $result['email'] = $this->getEmail();
        return $result;
    }

    /**
     * Add fShops
     *
     * @param \Listreat\MainBundle\Entity\Follow $fShops
     * @return User
     */
    public function addFShop(\Listreat\MainBundle\Entity\Follow $fShops)
    {
        $this->fShops[] = $fShops;
    
        return $this;
    }

    /**
     * Remove fShops
     *
     * @param \Listreat\MainBundle\Entity\Follow $fShops
     */
    public function removeFShop(\Listreat\MainBundle\Entity\Follow $fShops)
    {
        $this->fShops->removeElement($fShops);
        $fShops->getShop()->removeFollower($fShops);
        $fShops->setShop(null);
        $fShops->setUser(null);
    }

    /**
     * Get fShops
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFShops()
    {
        return $this->fShops;
    }

    /**
     * Set friends
     *
     * @param \Listreat\UserBundle\Entity\Friend $friends
     * @return User
     */
    public function setFriends(\Listreat\UserBundle\Entity\Friend $friends)
    {
        $this->friends = $friends;
    
        return $this;
    }

    /**
     * Get friends
     *
     * @return \Listreat\UserBundle\Entity\Friend 
     */
    public function getFriends()
    {
        return $this->friends;
    }

    /**
     * Set visibility
     *
     * @param \Listreat\UserBundle\Entity\Friend $visibility
     * @return User
     */
    public function setVisibility(\Listreat\UserBundle\Entity\Friend $visibility)
    {
        $this->visibility = $visibility;
    
        return $this;
    }

    /**
     * Get visibility
     *
     * @return \Listreat\UserBundle\Entity\Friend 
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Add friends
     *
     * @param \Listreat\UserBundle\Entity\Friend $friends
     * @return User
     */
    public function addFriend(\Listreat\UserBundle\Entity\Friend $friends)
    {
        $this->friends[] = $friends;
    
        return $this;
    }

    /**
     * Remove friends
     *
     * @param \Listreat\UserBundle\Entity\Friend $friends
     */
    public function removeFriend(\Listreat\UserBundle\Entity\Friend $friends)
    {
        $this->friends->removeElement($friends);
    }

    /**
     * Add visibility
     *
     * @param \Listreat\UserBundle\Entity\Friend $visibility
     * @return User
     */
    public function addVisibility(\Listreat\UserBundle\Entity\Friend $visibility)
    {
        $this->visibility[] = $visibility;
    
        return $this;
    }

    /**
     * Remove visibility
     *
     * @param \Listreat\UserBundle\Entity\Friend $visibility
     */
    public function removeVisibility(\Listreat\UserBundle\Entity\Friend $visibility)
    {
        $this->visibility->removeElement($visibility);
    }
}