<?php
namespace Bidweb\BidwebBundle\Entity;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BuildType
 *
 * @author HAMMAMI
 */

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="build_type")
 */

class BuildType {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     *  @ORM\Column(name="build_type",type="string",length=255)
     */
    private $build_type;

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
     * Set buildType
     *
     * @param string $buildType
     *
     * @return BuildType
     */
    public function setBuildType($buildType)
    {
        $this->build_type = $buildType;

        return $this;
    }

    /**
     * Get buildType
     *
     * @return string
     */
    public function getBuildType()
    {
        return $this->build_type;
    }
    
    public function __toString() {
        return $this->build_type;
    }
}
