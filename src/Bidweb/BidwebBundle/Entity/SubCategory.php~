<?php
namespace Bidweb\BidwebBundle\Entity;


/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubCategory
 *
 * @author HAMMAMI
 */


use Doctrine\ORM\Mapping as ORM; // this doctrine lib




/**
 * Category
 * @ORM\Entity(repositoryClass="Bidweb\BidwebBundle\Repository\SubCategoryRepository")
 * @ORM\Table(name="sub_category")
 */
class SubCategory {
    
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
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="subcategories")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;
    
    
    
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
     * @return SubCategory
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
     * @return SubCategory
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
     * @return SubCategory
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
     * @return SubCategory
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
     * Set category
     *
     * @param \Bidweb\BidwebBundle\Entity\Category $category
     * @return SubCategory
     */
    public function setCategory(\Bidweb\BidwebBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Bidweb\BidwebBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
