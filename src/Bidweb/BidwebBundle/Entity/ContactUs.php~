<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Bidweb\BidwebBundle\Entity;
/**
 * Description of ContactUs
 *
 * @author HAMMAMI
 */


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="contact_us")
 */
class ContactUs {
   /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
    /**
     * @ORM\Column(name="user_name", type="string", length=255, nullable=false)
     *
     * @Assert\NotBlank(message="Please enter your name.")
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="The name is too short.",
     *     maxMessage="The name is too long.",
     * )
     */
    private $userName;
    
    /**
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;
    
    /**
     * @ORM\Column(name="message", type="string", length=1000, nullable=false)
     * @Assert\NotBlank(message="Please enter your message.")
     * @Assert\Length(
     *     min=10,
     *     max="1000",
     *     minMessage="The message is too short.",
     *     maxMessage="The message is too long.",
     * )
     */
    private $message;
    
    /**
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;
    
    
    
    /**
     *  @ORM\Column(name="subject",type="string",length=255)
     */
    private $subject;
    
    
    public function __construct()
    {
        $this->created = new \DateTime();
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
     * Set userName
     *
     * @param string $userName
     * @return ContactUs
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    
        return $this;
    }

    /**
     * Get userName
     *
     * @return string 
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return ContactUs
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return ContactUs
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
     * Set created
     *
     * @param \DateTime $created
     * @return ContactUs
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
     * Set subject
     *
     * @param string $subject
     * @return ContactUs
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
}
