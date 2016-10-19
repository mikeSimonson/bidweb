<?php
namespace Bidweb\BidwebBundle\Entity;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Category
 *
 * @author HAMMAMI
 */

use Doctrine\ORM\Mapping as ORM; // this doctrine lib

use Doctrine\Common\Collections\ArrayCollection;


/**
 * Category
 * @ORM\Entity(repositoryClass="Bidweb\BidwebBundle\Repository\CategoryRepository")
 * @ORM\Table(name="category")
 */
class Category {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;
    
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ko_name", type="string", length=100, nullable=false)
     */
    private $koName;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="eng_name", type="string", length=100, nullable=false)
     */
    private $engName;
    
    
    /**
     * @ORM\OneToMany(targetEntity="SubCategory", mappedBy="category")
     **/
    protected $subcategories;
    
    
    public function __construct()
    {
        $this->subcategories = new ArrayCollection();
    }
    
    
    public function __toString()
    {
        return $this->name;
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
     * @return Category
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
     * Set status
     *
     * @param boolean $status
     * @return Category
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set koName
     *
     * @param string $koName
     * @return Category
     */
    public function setKoName($koName)
    {
        $this->koName = $koName;

        return $this;
    }

    /**
     * Get koName
     *
     * @return string 
     */
    public function getKoName()
    {
        return $this->koName;
    }

    /**
     * Set engName
     *
     * @param string $engName
     * @return Category
     */
    public function setEngName($engName)
    {
        $this->engName = $engName;

        return $this;
    }

    /**
     * Get engName
     *
     * @return string 
     */
    public function getEngName()
    {
        return $this->engName;
    }

    /**
     * Add subcategories
     *
     * @param \Bidweb\BidwebBundle\Entity\SubCategory $subcategories
     * @return Category
     */
    public function addSubcategory(\Bidweb\BidwebBundle\Entity\SubCategory $subcategories)
    {
        $this->subcategories[] = $subcategories;

        return $this;
    }

    /**
     * Remove subcategories
     *
     * @param \Bidweb\BidwebBundle\Entity\SubCategory $subcategories
     */
    public function removeSubcategory(\Bidweb\BidwebBundle\Entity\SubCategory $subcategories)
    {
        $this->subcategories->removeElement($subcategories);
    }

    /**
     * Get subcategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSubcategories()
    {
        return $this->subcategories;
    }
}
