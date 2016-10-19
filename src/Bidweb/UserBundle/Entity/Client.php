<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Bidweb\UserBundle\Entity;

/**
 * Description of Client
 *
 * @author Walid
 */

use Doctrine\ORM\Mapping as ORM;
use PUGX\MultiUserBundle\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
 
/**
 * @ORM\Entity
 * @ORM\Table(name="client")
 * @UniqueEntity(fields = "username", targetClass = "Bidweb\UserBundle\Entity\User", message="fos_user.username.already_used")
 * @UniqueEntity(fields = "email", targetClass = "Bidweb\UserBundle\Entity\User", message="fos_user.email.already_used")
 * @ORM\HasLifecycleCallbacks
 */

class Client extends User{
     /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    public function __construct()
    {
        parent::__construct();
        $this->modified=new \DateTime();
    }
    
    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=true)
     */
    private $address;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=100, nullable=true)
     */
    private $phone;
    
    /**
     * @ORM\Column(name="company_name", type="string", length=255, nullable=true)
     */
    private $companyName;
    
    
    /**
     *
     * @var string
     * @ORM\Column(name="city", type="string", length=255, nullable=true) 
     */
    private $city='';
    
    /**
     *
     * @var string
     * @ORM\Column(name="state", type="string", length=255, nullable=true) 
     */
    private $state='';
    
    /**
     *
     * @var string
     * @ORM\Column(name="country", type="string", length=255, nullable=true) 
     */
    private $country='';
    
    /**
     *
     * @var string
     * @ORM\Column(name="contact_email", type="string", length=255, nullable=true) 
     */
    private $contactEmail='';
    
    /**
     *
     * @var string
     * @ORM\Column(name="domain", type="string", length=255, nullable=true) 
     */
    private $domain='';
    
    /**
     *
     * @var string
     * @ORM\Column(name="paypal_email", type="string", length=255, nullable=true) 
     */
    private $paypalEmail='';
    
    /**
     *
     * @var string
     * @ORM\Column(name="web_site", type="string", length=255, nullable=true) 
     */
    private $webSite='';
    
    /**
     *
     * @var integer
     * @ORM\Column(name="zip_code", type="integer", length=255, nullable=true) 
     */
    private $zipCode;
    
    
    /**
     *
     * @var string
     * @ORM\Column(name="logo", type="string", length=255, nullable=true,options={"default":"empty"}) 
     */
    private $image='empty';

    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $tempFile;
    /**
     *
     * @var datetime
     * @ORM\Column(name="modified", type="datetime", nullable=false) 
     */
    private $modified;
    
    private $type="client";
    
    public function getType(){
        return $this->type;
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

    
    public function __toString() {
        return $this->getUsername();
    }
    
     /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->image);

        // check if we have an old image
        if (isset($this->tempFile)) {
            // delete the old image
            unlink($this->getUploadRootDir() . '/' . $this->tempFile);

            // clear the temp image path
            $this->tempFile = null;
        }
        $this->file = null;

//        // la propriété « file » peut être vide si le champ n'est pas requis
//        if (null === $this->file) {
//            return;
//        }
//        
//        if($this->file !== null){
//            $this->file->move($this->getUploadRootDir(),  $this->image);
//            
//            unset($this->file);
//        }
      
    }
    
    public function getFile() {
        return $this->file;
    }

    public function setFile(UploadedFile $file = null) {
        $this->file = $file;

        if (isset($this->image)) {
            // store the old name to delete after the update
            $this->tempfile = $this->image;
            $this->image = null;
        } else {
            $this->image = 'empty';
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->image = $filename . '.' . $this->getFile()->guessExtension();
            $this->modified=new \DateTime();
        }

//
//        if (null !== $this->getFile()) {
//            // faites ce que vous voulez pour générer un nom unique
//            $this->image = sha1(uniqid(mt_rand(), true)).'.'.$this->file->guessExtension();
//            
//        }
    }
    
   


    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($this->file = $this->getAbsolutImage()) {
            unlink($this->file);
        }
    }
    
    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/images';
    }
    
    public function getAbsolutImage()
    {
        return null === $this->image ? null : $this->getUploadRootDir().'/'.$this->image;
    }
    
    public function getWebPathImage()
    {
        return null === $this->image ? null : $this->getUploadDir().'/'.$this->image;
    }
    
   

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Client
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Client
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     *
     * @return Client
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Client
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Client
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Client
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set contactEmail
     *
     * @param string $contactEmail
     *
     * @return Client
     */
    public function setContactEmail($contactEmail)
    {
        $this->contactEmail = $contactEmail;

        return $this;
    }

    /**
     * Get contactEmail
     *
     * @return string
     */
    public function getContactEmail()
    {
        return $this->contactEmail;
    }

    /**
     * Set domain
     *
     * @param string $domain
     *
     * @return Client
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Set paypalEmail
     *
     * @param string $paypalEmail
     *
     * @return Client
     */
    public function setPaypalEmail($paypalEmail)
    {
        $this->paypalEmail = $paypalEmail;

        return $this;
    }

    /**
     * Get paypalEmail
     *
     * @return string
     */
    public function getPaypalEmail()
    {
        return $this->paypalEmail;
    }

    /**
     * Set webSite
     *
     * @param string $webSite
     *
     * @return Client
     */
    public function setWebSite($webSite)
    {
        $this->webSite = $webSite;

        return $this;
    }

    /**
     * Get webSite
     *
     * @return string
     */
    public function getWebSite()
    {
        return $this->webSite;
    }

    /**
     * Set zipCode
     *
     * @param integer $zipCode
     *
     * @return Client
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return integer
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set logo
     *
     * @param string $image
     *
     * @return Client
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     *
     * @return Client
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime
     */
    public function getModified()
    {
        return $this->modified;
    }
}
