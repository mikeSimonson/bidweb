<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Entity;

use Doctrine\ORM\Mapping as ORM; // this doctrine lib
/**
 * Description of Notification
 *
 * @author walid
 */

/**
 * Category
 * @ORM\Entity(repositoryClass="Bidweb\BidwebBundle\Repository\NotificationRepository")
 * @ORM\Table(name="notification")
 * @ORM\HasLifecycleCallbacks
 */
class Notification {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var \Bidweb\BidwebBundle\Entity\User
     * 
     * @ORM\ManyToOne(targetEntity="\Bidweb\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=false)
     */
    private $message;
    
     /**
     * @var string
     *
     * @ORM\Column(name="subject", type="text", nullable=false)
     */
    private $subject;
    
    /**
     * @var string
     *
     * @ORM\Column(name="url", type="text", nullable=true)
     */
    private $url;
    /**
     *
     * @var boolean
     * @ORM\Column(name="isread", type="boolean", nullable=false) 
     */
    private $read;
    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;

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
     * Set message
     *
     * @param string $message
     *
     * @return Notification
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set read
     *
     * @param boolean $read
     *
     * @return Notification
     */
    public function setRead($read)
    {
        $this->read = $read;

        return $this;
    }

    /**
     * Get read
     *
     * @return boolean
     */
    public function getRead()
    {
        return $this->read;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Notification
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set user
     *
     * @param \Bidweb\UserBundle\Entity\User $user
     *
     * @return Notification
     */
    public function setUser(\Bidweb\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Bidweb\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Notification
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Notification
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
