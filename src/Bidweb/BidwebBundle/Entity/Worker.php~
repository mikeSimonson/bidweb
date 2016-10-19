<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\BidwebBundle\Entity;

/**
 * Description of Worker
 *
 * @author HAMMAMI
 */

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="worker_job",options={"engine"="MyISAM"})
 */
class Worker {
    
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

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
     * @ORM\Column(name="start_day", type="datetime")
     */
    private $startDay;
    
    
    /**
     * @ORM\Column(name="end_day", type="datetime")
     */
    private $endDay;
    
    
  
    

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
     * Set startDay
     *
     * @param \DateTime $startDay
     *
     * @return Worker
     */
    public function setStartDay($startDay)
    {
        $this->startDay = $startDay;

        return $this;
    }

    /**
     * Get startDay
     *
     * @return \DateTime
     */
    public function getStartDay()
    {
        return $this->startDay;
    }

    /**
     * Set endDay
     *
     * @param \DateTime $endDay
     *
     * @return Worker
     */
    public function setEndDay($endDay)
    {
        $this->endDay = $endDay;

        return $this;
    }

    /**
     * Get endDay
     *
     * @return \DateTime
     */
    public function getEndDay()
    {
        return $this->endDay;
    }

    /**
     * Set profile
     *
     * @param \Bidweb\BidwebBundle\Entity\Profile $profile
     *
     * @return Worker
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

    /**
     * Set job
     *
     * @param \Bidweb\BidwebBundle\Entity\Job $job
     *
     * @return Worker
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
    
    public function __construct() {
        $this->startDay = new \DateTime();
        $this->endDay = new \DateTime();
    }
}
