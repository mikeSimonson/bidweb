<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Entity;

/**
 * Description of FeedBack
 *
 * @author walid
 */

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Bidweb\BidwebBundle\Repository\CityRepository")
 * @ORM\Table(name="feedback")
 */
class FeedBack {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;
    
    /**
     * @ORM\Column(name="message", type="string", length=1000, nullable=false)
     *
     */
    private $message;
    
    /**
     * @var \Bidweb\UserBundle\Entity\User
     * 
     * @ORM\ManyToOne(targetEntity="\Bidweb\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     *
     * @var integer
     * @ORM\Column(name="score", type="integer", length=255, nullable=true) 
     */
    private $score;

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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return FeedBack
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
     * Set message
     *
     * @param string $message
     *
     * @return FeedBack
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
     * Set score
     *
     * @param integer $score
     *
     * @return FeedBack
     */
    public function setScore($score)
    {
        $this->score = $score;
    
        return $this;
    }

    /**
     * Get score
     *
     * @return integer
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Set user
     *
     * @param \Bidweb\UserBundle\Entity\User $user
     *
     * @return FeedBack
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
}
