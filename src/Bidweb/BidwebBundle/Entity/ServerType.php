<?php

namespace Bidweb\BidwebBundle\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ServerType
 *
 * @author HAMMAMI
 */

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="server_type")
 */
class ServerType {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     *  @ORM\Column(name="server_type",type="string",length=255)
     */
    private $server_type;

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
     * Set serverType
     *
     * @param string $serverType
     *
     * @return ServerType
     */
    public function setServerType($serverType)
    {
        $this->server_type = $serverType;

        return $this;
    }

    /**
     * Get serverType
     *
     * @return string
     */
    public function getServerType()
    {
        return $this->server_type;
    }
    
    public function __toString() {
        return $this->server_type;
    }
}
