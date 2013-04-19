<?php

namespace Listreat\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Friend
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Listreat\UserBundle\Entity\FriendRepository")
 */
class Friend
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    /**
     * @var String status
     *
     * @ORM\Column(name="status", type="text", nullable=true)
     */
    private $status;
    
    /**
     * @ORM\ManyToOne(targetEntity="Listreat\UserBundle\Entity\User", inversedBy="friends")
     * @ORM\JoinColumn(nullable=true)
     */
    private $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Listreat\UserBundle\Entity\User", inversedBy="visibility")
     * @ORM\JoinColumn(nullable=true)
     */
    private $friend;
    

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
     * Set date
     *
     * @param \DateTime $date
     * @return Friend
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->date = new \DateTime('now');
    }
    
    /**
     * Set status
     *
     * @param string $status
     * @return Friend
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set user
     *
     * @param \Listreat\UserBundle\Entity\User $user
     * @return Friend
     */
    public function setUser(\Listreat\UserBundle\Entity\User $user = null)
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
     * Set friend
     *
     * @param \Listreat\UserBundle\Entity\User $friend
     * @return Friend
     */
    public function setFriend(\Listreat\UserBundle\Entity\User $friend = null)
    {
        $this->friend = $friend;
    
        return $this;
    }

    /**
     * Get friend
     *
     * @return \Listreat\UserBundle\Entity\User 
     */
    public function getFriend()
    {
        return $this->friend;
    }
}