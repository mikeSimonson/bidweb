<?php

namespace Bidweb\BidwebBundle\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WorkingType
 *
 * @author HAMMAMI
 */

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="working_type")
 */
class WorkingType {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     *  @ORM\Column(name="work_type",type="string",length=255)
     */
    private $workType;

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
     * Set workType
     *
     * @param string $workType
     * @return WorkingType
     */
    public function setWorkType($workType)
    {
        $this->workType = $workType;
    
        return $this;
    }

    /**
     * Get workType
     *
     * @return string 
     */
    public function getWorkType()
    {
        return $this->workType;
    }
    
    public function __toString() {
        return $this->workType;
    }
}
