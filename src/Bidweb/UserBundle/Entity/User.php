<?php
namespace Bidweb\UserBundle\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of User
 *
 * @author HAMMAMI
 */


/**
 * @ORM\Entity
 * @ORM\Table(name="bw_user")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"client" = "Client", "freelancer" = "Freelancer"})
 *
 */
abstract class User extends BaseUser{
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    private $type="user";
    
    public function getType(){
        return $this->type;
    }
    
}
