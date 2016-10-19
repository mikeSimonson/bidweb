<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Entity;

/**
 * Description of ApplicationProject
 *
 * @author Walid
 */

use Doctrine\ORM\Mapping as ORM; // this doctrine lib
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 * @ORM\Entity(repositoryClass="Bidweb\BidwebBundle\Repository\ApplicationProjectRepository")
 * @ORM\Table(name="application_projct")
 */
class ApplicationProject {
    
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
     * @var \Bidweb\UserBundle\Entity\Freelancer
     * 
     * @ORM\ManyToOne(targetEntity="\Bidweb\UserBundle\Entity\Freelancer")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $freelancer;

    /**
     * @var Project
     * 
     * @ORM\ManyToOne(targetEntity="Project")
     * @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     */
    protected $project;
    
   
    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status = 0;
    

    /**
     *
     * @var integer
     * @ORM\Column(name="budget", type="integer", length=255, nullable=true) 
     */
    private $budget;
    
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
     * Set job
     *
     * @param \Bidweb\BidwebBundle\Entity\Project $project
     * @return ApplicationProject
     */
    public function setProject(\Bidweb\BidwebBundle\Entity\Project $project = null)
    {
        $this->project = $project;
    
        return $this;
    }

    /**
     * Get project
     *
     * @return \Bidweb\BidwebBundle\Entity\Project 
     */
    public function getProject()
    {
        return $this->project;
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

    /**
     * Set budget
     *
     * @param integer $budget
     *
     * @return ApplicationProject
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return integer
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set freelancer
     *
     * @param \Bidweb\UserBundle\Entity\Freelancer $freelancer
     *
     * @return ApplicationProject
     */
    public function setFreelancer(\Bidweb\UserBundle\Entity\Freelancer $freelancer = null)
    {
        $this->freelancer = $freelancer;

        return $this;
    }

    /**
     * Get freelancer
     *
     * @return \Bidweb\UserBundle\Entity\Freelancer
     */
    public function getFreelancer()
    {
        return $this->freelancer;
    }
}
