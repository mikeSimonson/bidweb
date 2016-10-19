<?php
namespace Bidweb\BidwebBundle\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of City
 *
 * @author HAMMAMI
 */

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="Bidweb\BidwebBundle\Repository\CityRepository")
 * @ORM\Table(name="city")
 */
class City {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="State", inversedBy="cities")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="state_code", type="string", length=2, nullable=true)
     */
    private $stateCode;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="zip", type="integer", nullable=true)
     */
    private $zip;

    /**
     * @var float
     *
     * @ORM\Column(name="latitude", type="float", precision=10, scale=0, nullable=true)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="float", precision=10, scale=0, nullable=true)
     */
    private $longitude;

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
     * Set stateCode
     *
     * @param string $stateCode
     * @return City
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
     * Set name
     *
     * @param string $name
     * @return City
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
     * Set zip
     *
     * @param integer $zip
     * @return City
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    
        return $this;
    }

    /**
     * Get zip
     *
     * @return integer 
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set latitude
     *
     * @param float $latitude
     * @return City
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    
        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return City
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    
        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set state
     *
     * @param \Bidweb\BidwebBundle\Entity\State $state
     * @return City
     */
    public function setState(\Bidweb\BidwebBundle\Entity\State $state = null)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return \Bidweb\BidwebBundle\Entity\State 
     */
    public function getState()
    {
        return $this->state;
    }
    
    public function __toString(){
        return $this->getName();
    }
}
