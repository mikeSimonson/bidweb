<?php

namespace Bidweb\BidwebBundle\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApplicationJob
 *
 * @author HAMMAMI
 */
use Doctrine\ORM\Mapping as ORM; // this doctrine lib
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 * @ORM\Entity(repositoryClass="Bidweb\BidwebBundle\Repository\ApplicationJobRepository")
 * @ORM\Table(name="application_job")
 */
class ApplicationJob {

    public static $WAIT=0;
    public static $ACCEPTED=1;
    public static $DECLINED=2;
    public static $FINISHED=3;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @ORM\Column(name="message", type="string", length=1000, nullable=false)
     *
     * @Assert\NotBlank(message="Please enter your message")
     * @Assert\Length(
     *     min=5,
     *     max="1000",
     *     minMessage="The message is too short.",
     *     maxMessage="The message is too long.",
     * )
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
     * @var Job
     * 
     * @ORM\ManyToOne(targetEntity="Job")
     * @ORM\JoinColumn(name="job_id", referencedColumnName="id")
     */
    protected $job;
    
    /**
     * @var Profile
     * 
     * @ORM\ManyToOne(targetEntity="Profile")
     * @ORM\JoinColumn(name="profile_id", referencedColumnName="id")
     */
    protected $profile;

     /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status = 0;
    

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
     * @return ApplicationJob
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
     * @return ApplicationJob
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
     * Set user
     *
     * @param \Bidweb\UserBundle\Entity\User $user
     * @return ApplicationJob
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
     * Set job
     *
     * @param \Bidweb\BidwebBundle\Entity\Job $job
     * @return ApplicationJob
     */
    public function setJob(\Bidweb\BidwebBundle\Entity\Job $job = null)
    {
        $this->job = $job;
    
        return $this;
    }

    /**
     * Get job
     *
     * @return \Bidweb\BidwebBundle\Entity\Job 
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set profile
     *
     * @param \Bidweb\BidwebBundle\Entity\Profile $profile
     * @return ApplicationJob
     */
    public function setProfile(\Bidweb\BidwebBundle\Entity\Profile $profile = null)
    {
        $this->profile = $profile;
    
        return $this;
    }

    /**
     * Get profile
     *
     * @return \Bidweb\BidwebBundle\Entity\Profile 
     */
    public function getProfile()
    {
        return $this->profile;
    }
    
    public function __construct() {
        $this->created = new \DateTime();
        $this->status = ApplicationJob::$WAIT;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return ApplicationJob
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
