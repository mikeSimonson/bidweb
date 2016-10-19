<?php

namespace Bidweb\BidwebBundle\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Message
 *
 * @author HAMMAMI
 */

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="Bidweb\BidwebBundle\Repository\MessageRepository")
 * @ORM\Table(name="message")
 */
class Message {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="\Bidweb\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="receiver_id", referencedColumnName="id")
     */
    private $receiver;

    /**
     *
     * @ORM\ManyToOne(targetEntity="\Bidweb\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="sender_id", referencedColumnName="id")
     */
    private $sender;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=100, nullable=false)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=false)
     */
    private $message;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;
    
    /**
     *
     * @var boolean
     * @ORM\Column(name="isread", type="boolean", nullable=false) 
     */
    private $read;
    


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
     * Set subject
     *
     * @param string $subject
     * @return Message
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
     * Set message
     *
     * @param string $message
     * @return Message
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
    public function getMessage($length=null)
    {
        if (false === is_null($length) && $length > 0)
            return substr(html_entity_decode($this->message), 0, $length);
        else
            return html_entity_decode($this->message);
       
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Message
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
     * Set read
     *
     * @param boolean $read
     * @return Message
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
     * Set receiver
     *
     * @param \Bidweb\BidwebBundle\Entity\User $receiver
     * @return Message
     */
    public function setReceiver(\Bidweb\UserBundle\Entity\User $receiver = null)
    {
        $this->receiver = $receiver;
    
        return $this;
    }

    /**
     * Get receiver
     *
     * @return \Bidweb\BidwebBundle\Entity\User 
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * Set sender
     *
     * @param \Bidweb\BidwebBundle\Entity\User $sender
     * @return Message
     */
    public function setSender(\Bidweb\UserBundle\Entity\User $sender = null)
    {
        $this->sender = $sender;
    
        return $this;
    }

    /**
     * Get sender
     *
     * @return \Bidweb\BidwebBundle\Entity\User 
     */
    public function getSender()
    {
        return $this->sender;
    }
    
    public function __toString() {
        return $this->subject;
    }
}
