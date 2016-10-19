<?php

namespace Bidweb\BidwebBundle\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of State
 *
 * @author HAMMAMI
 */

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="state")
 */
class State {
    
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

   
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="state_code", type="string", length=2, nullable=true)
     */
    private $stateCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status = '1';

    /**
     * @ORM\OneToMany(targetEntity="City", mappedBy="state")
     **/
    protected $cities;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->cities = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return State
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set stateCode
     *
     * @param string $stateCode
     * @return State
     */
    public function setStateCode($stateCode)
    {
        $this->stateCode = $stateCode;
    
        return $this;
    }

    /**
     * Get stateCode
     *
     * @return string 
     */
    public function getStateCode()
    {
        return $this->stateCode;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return State
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
     * Add cities
     *
     * @param \Bidweb\BidwebBundle\Entity\City $cities
     * @return State
     */
    public function addCity(\Bidweb\BidwebBundle\Entity\City $cities)
    {
        $this->cities[] = $cities;
    
        return $this;
    }

    /**
     * Remove cities
     *
     * @param \Bidweb\BidwebBundle\Entity\City $cities
     */
    public function removeCity(\Bidweb\BidwebBundle\Entity\City $cities)
    {
        $this->cities->removeElement($cities);
    }

    /**
     * Get cities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCities()
    {
        return $this->cities;
    }
    
    public function __toString(){
        return $this->getName();
    }
}
